<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\HenXemQueuedMailer;

use App\Models\HopDong;
use App\Models\User;
use App\Models\VanPhong;
use App\Models\ChiTietHopDong;
use App\Models\ToaNha;
use App\Models\LichSuCoc;
use App\Models\HopDongThanhLy;
use App\Models\HenXem;
use App\Models\Mau;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Mail\HopDongMoiMail;
use Carbon\Carbon;


class HopDongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HopDong::with([
            'user',
            'chiTietHopDongs.vanPhong.toaNha',
            'hoaDons' => function ($query) {
                $query->where('trang_thai', 'chua thanh toan');
            }
        ]);

        if ($request->filled('nam')) {
            $query->whereYear('ngay_ky', $request->nam);
        }

        if ($request->filled('tinh_trang_hop_dong')) {
            $query->whereIn('tinh_trang', (array) $request->tinh_trang_hop_dong);
        }

        if ($request->filled('toa_nha')) {
            $query->whereHas('chiTietHopDongs.vanPhong', function ($q) use ($request) {
                $q->where('ma_toa_nha', $request->toa_nha);
            });
        }

        $hopDongs = $query->orderBy('ngay_ky', 'desc')->get();

        $today = Carbon::today();

        $hopDongsCanThanhLy = $hopDongs->filter(function ($hopdong) use ($today) {
            $ngayKetThuc = Carbon::parse($hopdong->ngay_ket_thuc);
            $soNgayConLai = $ngayKetThuc->diffInDays($today, false);

            return !$hopdong->da_thanh_ly && (
                $soNgayConLai >= -7 && $soNgayConLai <= 0
            );
        });
        $dsToaNha = ToaNha::all();

        return view('admin.hopdong.index', compact('hopDongs', 'hopDongsCanThanhLy', 'dsToaNha'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $selectedUserId = $request->query('user_id');
        $selectedVanPhongId = $request->query('vanphong_id');

        $users = User::where('vai_tro', 'KT')->where('trang_thai', 1)->get();

        if ($selectedUserId && !$users->pluck('id')->contains($selectedUserId)) {
            $user = User::find($selectedUserId);
            if ($user) {
                if ($user->trang_thai == 0) {
                    return redirect()->route('admin.hopdong.index')
                        ->with(['error' => 'Người dùng đã bị vô hiệu hóa, không thể lập hợp đồng.']);
                }

                $users->push($user);
            }
        }

        $toaNhas = ToaNha::with('vanPhongs')->where('trang_thai', 'hoat dong')->get();

        if ($selectedVanPhongId) {
            $vanPhongs = VanPhong::with('toaNha')->where('ma_van_phong', $selectedVanPhongId)->get();
        } else {
            $vanPhongs = VanPhong::with('toaNha')->where('trang_thai', 'dang trong')
                ->get();
        }

        if ($selectedVanPhongId) {
            $selectedVanPhong = $vanPhongs->first(function ($vp) use ($selectedVanPhongId) {
                return (string) $vp->ma_van_phong === (string) $selectedVanPhongId;
            });
            $selectedToaNhaId = $selectedVanPhong?->toaNha?->ma_toa_nha ?? null;

            Log::debug('Selected VanPhong:', [$selectedVanPhong]);
            Log::debug('Related ToaNha:', [$selectedVanPhong?->toaNha]);
            if (
                !$selectedVanPhong ||
                $selectedVanPhong->trang_thai === 'khong hoat dong' ||
                $selectedVanPhong->toaNha?->trang_thai === 'khong hoat dong'
            ) {
                return redirect()->route('admin.hopdong.index')
                    ->with(['error' => 'Văn phòng hoặc tòa nhà đã ngưng hoạt động, không thể lập hợp đồng.']);
            }
        } else {
            $selectedToaNhaId = null;
        }
        return view('admin.hopdong.create', compact(
            'users',
            'vanPhongs',
            'toaNhas',
            'selectedUserId',
            'selectedVanPhongId',
            'selectedToaNhaId'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'toa_nha_id' => 'required|exists:toa_nha,ma_toa_nha',
            'vanphong_id' => 'required|exists:van_phong,ma_van_phong',
            'ngay_ky' => 'required|date',
            'ngay_bat_dau' => 'required|date|after_or_equal:ngay_ky',
            'han_hop_dong' => 'required|date|after:ngay_bat_dau',

            'khach_thue_id' => 'required|exists:users,id',
            'sdt_khach_thue' => 'nullable|string|max:20',
            'dai_dien' => 'nullable|string|max:100',

            'tien_thue' => 'required|numeric|min:0',
            'ngay_bat_dau_tinh_tien' => 'required|date|after_or_equal:ngay_bat_dau',
            'tien_coc' => 'required|numeric|min:0',

            'gia_dien' => 'required|numeric|min:0',
            'gia_nuoc' => 'required|numeric|min:0',
            'dich_vu_khac' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);
        Log::info('Request data:', $request->all());
        DB::beginTransaction();
        try {
            $hopDong = HopDong::create([
                'user_id' => $validated['khach_thue_id'],
                'ngay_ky' => $validated['ngay_ky'],
                'ngay_bat_dau' => $validated['ngay_bat_dau'],
                'ngay_ket_thuc' => $validated['han_hop_dong'],
                'tong_tien_coc' => $validated['tien_coc'],
                'tinh_trang' => 'da lap',
                'ghi_chu_thanh_ly' => $validated['ghi_chu'] ?? null,
            ]);
            Log::info('Tạo hợp đồng:', $hopDong->toArray());
            $vanPhong = VanPhong::findOrFail($validated['vanphong_id']);
            Log::debug('VanPhong ID:', [$validated['vanphong_id']]);
            ChiTietHopDong::create([
                'ma_hop_dong' => $hopDong->ma_hop_dong,
                'ma_van_phong' => $validated['vanphong_id'],
                'dien_tich' => $vanPhong->dien_tich,
                'gia_thue' => $validated['tien_thue'],
                'gia_dien' => $validated['gia_dien'],
                'gia_nuoc' => $validated['gia_nuoc'],
                'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
            ]);
            Log::debug('Dữ liệu Chi Tiết HĐ:', [
                'ma_hop_dong' => $hopDong->ma_hop_dong,
                'ma_van_phong' => $validated['vanphong_id'],
                'dien_tich' => $vanPhong->dien_tich,
                'gia_thue' => $validated['tien_thue'],
                'gia_dien' => $validated['gia_dien'],
                'gia_nuoc' => $validated['gia_nuoc'],
                'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
            ]);
            LichSuCoc::create([
                'ma_hop_dong' => $hopDong->ma_hop_dong,
                'so_tien' => $validated['tien_coc'],
                'ngay_coc' => $validated['ngay_ky'],
                'ngay_tra_phong' => $validated['han_hop_dong'],
                'tinh_trang_hoan' => 'chua hoan',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Cọc ban đầu khi ký hợp đồng'
            ]);

            DB::commit();

            $maVanPhong = $request->vanphong_id;
            $emailHopDong = User::where('id', $request->khach_thue_id)->value('email');

            $dsHenXemBiHuy = HenXem::with('vanphong')
                ->where('ma_van_phong', $maVanPhong)
                ->whereIn('trang_thai', ['dang xu ly', 'chua xu ly', 'da xu ly'])
                ->where('email', '!=', $emailHopDong)
                ->get();

            $henXemDaXuLy = HenXem::with('vanphong')
                ->where('ma_van_phong', $maVanPhong)
                ->whereIn('trang_thai', ['dang xu ly', 'chua xu ly', 'da xu ly'])
                ->where('email', $emailHopDong)
                ->first();

            if ($henXemDaXuLy) {
                $henXemDaXuLy->trang_thai = 'da xu ly';
                $henXemDaXuLy->save();
            }

            foreach ($dsHenXemBiHuy as $henxem) {
                $henxem->trang_thai = 'da huy';
                $henxem->save();

                if ($henxem->email) {
                    $henxem->load('vanphong');
                    Mail::to($henxem->email)->queue(new HenXemQueuedMailer($henxem));
                }
            }

            return redirect()->route('admin.hopdong.index')->with('success', 'Tạo hợp đồng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }

    public function xacNhanDaKy(Request $request)
    {
        $hopDongId = $request->input('hop_dong_id');

        $hopDong = HopDong::find($hopDongId);

        if (!$hopDong) {
            return response()->json(['success' => false, 'message' => 'Hợp đồng không tồn tại']);
        }

        $chiTiet = ChiTietHopDong::where('ma_hop_dong', $hopDongId)->first();
        if (!$chiTiet) {
            return response()->json(['success' => false, 'message' => 'Chi tiết hợp đồng không tồn tại']);
        }

        $vanPhong = VanPhong::find($chiTiet->ma_van_phong);
        if (!$vanPhong) {
            return response()->json(['success' => false, 'message' => 'Văn phòng không tồn tại']);
        }

        $hopDong->tinh_trang = 'da ky';
        $hopDong->save();

        $vanPhong->trang_thai = 'cho ban giao';
        $vanPhong->save();

        try {
            $user = $hopDong->user;

            if ($user && $user->email) {
                Mail::to($user->email)->send(new HopDongMoiMail($user, $hopDong));
            } else {
                Log::warning("User {$user->id} không có email để gửi thông báo hợp đồng.");
            }
        } catch (\Exception $e) {
            Log::error("Gửi email thông báo hợp đồng thất bại: " . $e->getMessage());
        }


        return response()->json(['success' => true]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $hopdong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->where('ma_hop_dong', $id)
            ->firstOrFail();
        $chiTiet = $hopdong->chiTietHopDongs->first();
        $vanPhong = $chiTiet->vanPhong;
        $toaNha = $vanPhong->toaNha;

        $mau = Mau::where('ten_mau', 'Hợp đồng')->orderByDesc('phien_ban')->first();
        $noiDung = $mau->noi_dung;

        $values = [
            'MA_HOP_DONG' => $hopdong->ma_hop_dong,
            'TEN_KHACH_HANG' => $hopdong->user->name ?? 'Không có',
            'DIA_CHI_KHACH_HANG' => $hopdong->user->dia_chi ?? 'Không rõ',
            'SDT_KHACH_HANG' => $hopdong->user->so_dien_thoai ?? 'Không rõ',
            'DAI_DIEN_KHACH_HANG' => $hopdong->user->name ?? 'Không có',
            'EMAIL_KHACH_HANG' => $hopdong->user->email ?? 'Không rõ',
            'CCCD_KHACH_HANG' => $hopdong->user->cccd ?? 'Không rõ',

            'DIA_CHI_TOA_NHA' => $toaNha->dia_chi ?? '[Địa chỉ tòa nhà]' ,
            'TEN_TOA_NHA' => $toaNha->ten_toa_nha ?? '[Tên tòa nhà]',
            'MA_VAN_PHONG' =>  $vanPhong->ma_van_phong ?? '[Mã văn phòng]',
            'DIEN_TICH_VAN_PHONG' => $chiTiet->dien_tich,

            'NGAY_BAT_DAU' => \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y'),
            'NGAY_KET_THUC' =>  \Carbon\Carbon::parse($hopdong->ngay_ket_thuc)->format('d/m/Y'),

            'GIA_THUE' => number_format($chiTiet->gia_thue ?? 0, 0, ',', '.'),
            'PHI_DICH_VU' => number_format($chiTiet->dich_vu_khac ?? 0, 0, ',', '.'),
            'GIA_DIEN' => number_format($chiTiet->gia_dien ?? 0, 0, ',', '.'),
            'GIA_NUOC' => number_format($chiTiet->gia_nuoc ?? 0, 0, ',', '.'),
            'TIEN_COC' => number_format($hopdong->tong_tien_coc ?? 0, 0, ',', '.'),


            'NGAY_KY_D' => \Carbon\Carbon::parse($hopdong->ngay_ky)->format('d'),
            'NGAY_KY_M' => \Carbon\Carbon::parse($hopdong->ngay_ky)->format('m') ,
            'NGAY_KY_Y' => \Carbon\Carbon::parse($hopdong->ngay_ky)->format('y'),
        ];

        foreach ($values as $key => $value) {
            $noiDung = str_replace('{{ ' . $key . ' }}', $value, $noiDung);
        }

        Log::info('HopDong:', $hopdong->toArray());
        Log::info('ChiTiet:', $chiTiet->toArray());
        Log::info('VanPhong:', $vanPhong->toArray());
        Log::info('ToaNha:', $toaNha->toArray());

        return view('admin.hopdong.preview', ['noiDung' => $noiDung]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hopDong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])->findOrFail($id);
        $toaNhas = ToaNha::where('trang_thai', 'hoat dong')->get();
        $users = User::where('vai_tro', 'KT')->where('trang_thai', 1)->get();
        $chiTiet = $hopDong->chiTietHopDongs->first();
        $vanPhong = $chiTiet?->vanPhong;

        $vanPhongs = VanPhong::with('toaNha')->get();

        return view('admin.hopdong.edit', compact(
            'hopDong',
            'toaNhas',
            'users',
            'chiTiet',
            'vanPhong',
            'vanPhongs'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hopDong = HopDong::findOrFail($id);

        if (now()->greaterThanOrEqualTo($hopDong->ngay_bat_dau) || $hopDong->da_thanh_ly) {
            return back()->withErrors(['error' => 'Hợp đồng đã có hiệu lực hoặc đã thanh lý, không thể chỉnh sửa.']);
        }
        $validated = $request->validate([
            'toa_nha_id' => 'required|exists:toa_nha,ma_toa_nha',
            'vanphong_id' => 'required|exists:van_phong,ma_van_phong',
            'ngay_ky' => 'required|date',
            'ngay_bat_dau' => 'required|date|after_or_equal:ngay_ky',
            'han_hop_dong' => 'required|date|after:ngay_bat_dau',

            'khach_thue_id' => 'required|exists:users,id',
            'sdt_khach_thue' => 'nullable|string|max:20',
            'dai_dien' => 'nullable|string|max:100',

            'tien_thue' => 'required|numeric|min:0',
            'ngay_bat_dau_tinh_tien' => 'required|date|after_or_equal:ngay_bat_dau',
            'tien_coc' => 'required|numeric|min:0',

            'gia_dien' => 'required|numeric|min:0',
            'gia_nuoc' => 'required|numeric|min:0',
            'dich_vu_khac' => 'nullable|numeric|min:0',
            'ghi_chu' => 'nullable|string|max:255',
            'tinh_trang' => 'required|string',
        ]);

        Log::info('Validated Data:', $validated);
        $maVanPhongCu = $request->input('vanphong_id_cu');

        DB::beginTransaction();
        try {
            $hopDong = HopDong::findOrFail($id);
            $hopDong->update([
                'user_id' => $validated['khach_thue_id'],
                'ngay_bat_dau' => $validated['ngay_bat_dau'],
                'ngay_ket_thuc' => $validated['han_hop_dong'],
                'tong_tien_coc' => $validated['tien_coc'],
                'tinh_trang' => $validated['tinh_trang'],
            ]);
            Log::info('Validated Data updatehd');

            $chiTiet = ChiTietHopDong::where('ma_hop_dong', $hopDong->ma_hop_dong)
                ->where('ma_van_phong', $maVanPhongCu)
                ->first();
            Log::info('Tìm chi tiết:', ['ma_hop_dong' => $hopDong->ma_hop_dong, 'ma_van_phong_cu' => $maVanPhongCu]);
            //dd($chiTiet);
            if ($chiTiet) {
                Log::info('updatechi tiet:');
                if ($validated['vanphong_id'] == $maVanPhongCu) {
                    $chiTiet->update([
                        'gia_thue' => $validated['tien_thue'],
                        'gia_dien' => $validated['gia_dien'],
                        'gia_nuoc' => $validated['gia_nuoc'],
                        'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
                    ]);
                } else {
                    Log::info('→ Bắt đầu xử lý văn phòng mới');

                    $vanPhongMoi = VanPhong::findOrFail($validated['vanphong_id']);
                    Log::info('→ Tìm được văn phòng mới', $vanPhongMoi->toArray());

                    try {
                        $chiTiet->forceDelete();
                        Log::info('→ Đã xóa chi tiết cũ', $chiTiet->toArray());
                    } catch (\Exception $e) {
                        Log::error('Lỗi khi xóa chi tiết cũ: ' . $e->getMessage());
                    }
                    $newChiTiet = ChiTietHopDong::create([
                        'ma_hop_dong' => $hopDong->ma_hop_dong,
                        'ma_van_phong' => $validated['vanphong_id'],
                        'dien_tich' => $vanPhongMoi->dien_tich,
                        'gia_thue' => $validated['tien_thue'],
                        'gia_dien' => $validated['gia_dien'],
                        'gia_nuoc' => $validated['gia_nuoc'],
                        'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
                    ]);
                    Log::info('→ Đã tạo mới chi tiết hợp đồng', $newChiTiet->toArray());
                }
            } else {
                Log::error("Không tìm thấy chi tiết hợp đồng");
                throw new \Exception("Không tìm thấy chi tiết hợp đồng");
            }

            DB::commit();

            return redirect()->route('admin.hopdong.index')->with('success', 'Cập nhật hợp đồng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function thanhLy(Request $request, $maHopDong)
    {
        $request->validate([
            'ly_do' => 'required|in:Khách rời phòng,Khách bỏ cọc',
            'ngay_thanh_ly' => 'required|date',
        ]);

        $lyDo = $request->ly_do === 'Khách rời phòng' ? 'roi_phong' : 'bo_coc';

        if ($lyDo === 'roi_phong') {
            $request->validate([
                'tong_no' => 'required|numeric|min:0',
                'phi_phat' => 'required|numeric|min:0',
                'hoan_tra_coc' => 'required|numeric|min:0',
                'tong_cong' => 'required|numeric',
            ]);
        }

        HopDongThanhLy::create([
            'ma_hop_dong' => $maHopDong,
            'ngay_chuyen_di' => $request->ngay_thanh_ly,
            'ly_do_thanh_ly' => $lyDo,
            'cong_no' => $lyDo === 'roi_phong' ? $request->tong_no : 0,
            'hoan_tra_tien_coc' => $lyDo === 'roi_phong' ? $request->hoan_tra_coc : 0,
            'phi_phat' => $lyDo === 'roi_phong' ? $request->phi_phat : 0,
            'tong_thanh_toan' => $lyDo === 'roi_phong' ? $request->tong_cong : 0,
        ]);

        HopDong::where('ma_hop_dong', $maHopDong)->update([
            'da_thanh_ly' => true,
            'tinh_trang' => 'da thanh ly',
            'ngay_thanh_ly' => $request->ngay_thanh_ly,
        ]);

        $chiTietHopDong = ChiTietHopDong::where('ma_hop_dong', $maHopDong)->first();
        if ($chiTietHopDong) {
            $vanPhong = $chiTietHopDong->vanPhong;
            if ($vanPhong) {
                $vanPhong->update(['trang_thai' => 'dang trong']);
            }
        }

        return redirect()->back()->with('success', 'Đã thanh lý hợp đồng thành công.');
    }
    public function showBienBanThanhLy($id)
    {
        $hopdong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->where('ma_hop_dong', $id)
            ->firstOrFail();

        if (!$hopdong->da_thanh_ly) {
            return redirect()->back()->with('error', 'Hợp đồng này chưa được thanh lý.');
        }

        $thanhLy = HopDongThanhLy::where('ma_hop_dong', $hopdong->ma_hop_dong)->first();

        if (!$thanhLy) {
            return redirect()->back()->with('error', 'Không tìm thấy biên bản thanh lý.');
        }
        
        $mau = Mau::where('ten_mau', 'Thanh lý')->orderByDesc('phien_ban')->first();
        $noiDung = $mau->noi_dung;

        $values = [

            'MA_HOP_DONG' => $hopdong->ma_hop_dong,
            'TEN_KHACH_HANG' => $hopdong->user->name ?? 'Không có',
            'DIA_CHI_KHACH_HANG' => $hopdong->user->dia_chi ?? 'Không rõ',
            'SDT_KHACH_HANG' => $hopdong->user->so_dien_thoai ?? 'Không rõ',
            'DAI_DIEN_KHACH_HANG' => $hopdong->user->name ?? 'Không có',
            'EMAIL_KHACH_HANG' => $hopdong->user->email ?? 'Không rõ',
            'CCCD_KHACH_HANG' => $hopdong->user->cccd ?? 'Không rõ',

            'NGAY_THANH_LY_D' => \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('d'),
            'NGAY_THANH_LY_M' => \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('m') ,
            'NGAY_THANH_LY_Y' => \Carbon\Carbon::parse($thanhLy->ngay_thanh_ly)->format('y'),
            'NGAY_KY' =>\Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y') ,
            'NGAY_BAT_DAU' => \Carbon\Carbon::parse($hopdong->ngay_bat_dau)->format('d/m/Y'),
            'NGAY_KET_THUC' => \Carbon\Carbon::parse($hopdong->ngay_ket_thuc)->format('d/m/Y'),
            'TONG_THANH_TOAN' => number_format(abs($thanhLy->tong_thanh_toan), 0, ',', '.'),

            'NGAY_CHUYEN_DI'=>\Carbon\Carbon::parse($thanhLy->ngay_chuyen_di)->format('d/m/Y'),
            'CONG_NO'=> number_format($thanhLy->cong_no, 0, ',', '.'),
            'HOAN_COC'=> number_format($thanhLy->hoan_tra_tien_coc, 0, ',', '.'),
            'PHI_PHAT'=>number_format($thanhLy->phi_phat, 0, ',', '.'),
        ];

        if ($thanhLy->tong_thanh_toan < 0) {
            $values['TONG'] = 'Bên A có trách nhiệm hoàn trả lại số tiền ' . number_format(abs($thanhLy->tong_thanh_toan), 0, ',', '.') . ' VNĐ cho Bên B.';
        } elseif ($thanhLy->tong_thanh_toan > 0) {
            $values['TONG'] = 'Bên B có nghĩa vụ thanh toán số tiền ' . number_format($thanhLy->tong_thanh_toan, 0, ',', '.') . ' VNĐ để hoàn tất các công nợ với Bên A.';
        } else {
            $values['TONG'] = 'Hai bên không còn khoản công nợ nào phải thanh toán.';
        }

        switch ($thanhLy->ly_do_thanh_ly) {
            case 'roi_phong':
                $values['LY_DO'] = 'Rời phòng';
                break;
            case 'bo_coc':
                $values['LY_DO'] = 'Bỏ cọc';
                break;
            default:
                $values['LY_DO'] = $thanhLy->ly_do_thanh_ly;
                break;
        }

        foreach ($values as $key => $value) {
            $noiDung = str_replace('{{ ' . $key . ' }}', $value, $noiDung);
        }

        return view('admin.hopdong.preview_thanhly', ['noiDung' => $noiDung]);
    }


    public function exportPDF($id)
    {
        $hopdong = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->where('ma_hop_dong', $id)
            ->firstOrFail();
        $chiTiet = $hopdong->chiTietHopDongs->first();
        $vanPhong = $chiTiet->vanPhong;
        $toaNha = $vanPhong->toaNha;

        $pdf = Pdf::loadView('admin.hopdong.export_pdf',  [
            'hopdong' => $hopdong,
            'toaNha' => $toaNha,
            'vanPhong' => $vanPhong,
            'chiTiet' => $chiTiet
        ])->setPaper('A4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'enable_css_float' => true,
                'chroot' => [public_path(), storage_path()]
            ]);

        return $pdf->download("hopdong-{$hopdong->ma_hop_dong}.pdf");
    }

    public function mau($tenmau)
    {
        $mau = Mau::where('ten_mau', $tenmau)
        ->orderByDesc('phien_ban')
        ->first();

        return view('admin.hopdong.mau', compact('mau','tenmau'));
    }
    
    public function taomau(Request $request)
    {
        $tenMau = $request->input('ten_mau');
        $noiDung = $request->input('noi_dung');

        $mauMoiNhat = Mau::where('ten_mau', $tenMau)->orderByDesc('phien_ban')->first();
        $phienBanMoi = $mauMoiNhat ? $mauMoiNhat->phien_ban + 1 : 1;

        $mau = new Mau();
        $mau->ten_mau = $tenMau;
        $mau->phien_ban = $phienBanMoi;
        $mau->noi_dung = $noiDung;
        $mau->save();

        return redirect()->back()->with('success', 'Tạo mẫu phiên bản mới thành công!');
    }

}