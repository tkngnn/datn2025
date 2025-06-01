<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HopDong;
use App\Models\User;
use App\Models\VanPhong;
use App\Models\ChiTietHopDong;
use App\Models\ToaNha;
use App\Models\LichSuCoc;
use App\Models\HopDongThanhLy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class HopDongController extends Controller
{
    /**
     * Display a listing of the resource.

    public function index()
    {
        $hopDongs = HopDong::with(['user', 'chiTietHopDongs.vanPhong.toaNha'])
            ->orderBy('ngay_ky', 'desc')
            ->get();

        return view('admin.hopdong.index', compact('hopDongs'));
    }     */
    public function index()
    {
        $hopDongs = HopDong::with([
            'user',
            'chiTietHopDongs.vanPhong.toaNha',
            'hoaDons' => function ($query) {
                $query->where('trang_thai', 'chua thanh toan'); // hoặc tên field trạng thái đúng của bạn
            }
        ])->orderBy('ngay_ky', 'desc')->get();

        return view('admin.hopdong.index', compact('hopDongs'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('vai_tro', 'KT')->get();
        $toaNhas = ToaNha::with('vanPhongs')->get();
        $vanPhongs = VanPhong::with('toaNha')->get();

        return view('admin.hopdong.create', compact('users', 'vanPhongs', 'toaNhas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDATION
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
            'chu_ky' => 'required|in:1,3,6,12',
            'ngay_bat_dau_tinh_tien' => 'required|date|after_or_equal:ngay_bat_dau',
            'tien_coc' => 'required|numeric|min:0',

            'gia_dien' => 'required|numeric|min:0',
            'gia_nuoc' => 'required|numeric|min:0',
            'dich_vu_khac' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 2. TẠO HỢP ĐỒNG
            $hopDong = HopDong::create([
                'user_id' => $validated['khach_thue_id'],
                'ngay_ky' => $validated['ngay_ky'],
                'ngay_bat_dau' => $validated['ngay_bat_dau'],
                'ngay_ket_thuc' => $validated['han_hop_dong'],
                'tong_tien_coc' => $validated['tien_coc'],
                'tinh_trang' => 'Đang thuê',
                'ghi_chu_thanh_ly' => $validated['ghi_chu'] ?? null,
            ]);

            // 3. LẤY DIỆN TÍCH VĂN PHÒNG
            $vanPhong = VanPhong::findOrFail($validated['vanphong_id']);

            // 4. CHI TIẾT HỢP ĐỒNG
            ChiTietHopDong::create([
                'ma_hop_dong' => $hopDong->ma_hop_dong,
                'ma_van_phong' => $validated['vanphong_id'],
                'dien_tich' => $vanPhong->dien_tich,
                'gia_thue' => $validated['tien_thue'],
                'gia_dien' => $validated['gia_dien'],
                'gia_nuoc' => $validated['gia_nuoc'],
                'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
            ]);

            // 5. LỊCH SỬ CỌC
            LichSuCoc::create([
                'ma_hop_dong' => $hopDong->ma_hop_dong,
                'so_tien' => $validated['tien_coc'],
                'ngay_coc' => $validated['ngay_ky'],
                'ngay_tra_phong' => $validated['han_hop_dong'],
                'tinh_trang_hoan' => 'Chưa hoàn',
                'so_tien_hoan' => null,
                'ghi_chu' => 'Cọc ban đầu khi ký hợp đồng'
            ]);

            // 6. CẬP NHẬT TRẠNG THÁI VĂN PHÒNG
            $vanPhong->update([
                'trang_thai' => 'da_thue'
            ]);

            DB::commit();

            return redirect()->route('admin.hopdong.index')->with('success', 'Tạo hợp đồng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
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



        Log::info('HopDong:', $hopdong->toArray());
        Log::info('ChiTiet:', $chiTiet->toArray());
        Log::info('VanPhong:', $vanPhong->toArray());
        Log::info('ToaNha:', $toaNha->toArray());

        return view('admin.hopdong.preview', compact('hopdong', 'chiTiet', 'vanPhong', 'toaNha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hopDong = HopDong::with(['user', 'chiTietHopDongs.vanPhong'])->findOrFail($id);
        $toaNha = ToaNha::all();
        $users = User::all();
        $chiTiet = $hopDong->chiTietHopDongs->first();
        $vanPhong = $chiTiet?->vanPhong;

        return view('admin.hopdong.edit', compact('hopDong', 'toaNha', 'users', 'chiTiet', 'vanPhong'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. VALIDATION
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
            'chu_ky' => 'required|in:1,3,6,12',
            'ngay_bat_dau_tinh_tien' => 'required|date|after_or_equal:ngay_bat_dau',
            'tien_coc' => 'required|numeric|min:0',

            'gia_dien' => 'required|numeric|min:0',
            'gia_nuoc' => 'required|numeric|min:0',
            'dich_vu_khac' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'ghi_chu' => 'nullable|string|max:255',
            'tinh_trang' => 'required|string',
        ]);

        Log::info('Validated Data:', $validated);

        DB::beginTransaction();
        try {
            // 2. TÌM HỢP ĐỒNG THEO ID
            $hopDong = HopDong::findOrFail($id);

            // 3. CẬP NHẬT HỢP ĐỒNG
            $hopDong->update([
                'user_id' => $validated['khach_thue_id'],
                'ngay_bat_dau' => $validated['ngay_bat_dau'],
                'ngay_ket_thuc' => $validated['han_hop_dong'],
                'tong_tien_coc' => $validated['tien_coc'],
                'tinh_trang' => $validated['tinh_trang'],
            ]);

            $chiTiet = ChiTietHopDong::where('ma_hop_dong', $hopDong->ma_hop_dong)->firstOrFail();

            $vanPhong = VanPhong::findOrFail($validated['vanphong_id']);

            $chiTiet->update([
                'gia_thue' => $validated['tien_thue'],
                'gia_dien' => $validated['gia_dien'],
                'gia_nuoc' => $validated['gia_nuoc'],
                'dich_vu_khac' => $validated['dich_vu_khac'] ?? 0,
            ]);


            DB::commit();

            return redirect()->route('admin.hopdong.index')->with('success', 'Cập nhật hợp đồng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
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
            'tinh_trang' => 'Da thanh ly',
        ]);

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

        return view('admin.hopdong.preview_thanhly', compact('hopdong', 'thanhLy'));
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
}
