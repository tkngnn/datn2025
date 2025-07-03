<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VanPhong;
use App\Models\ToaNha;
use App\Models\HenXem;
use App\Models\User;
use Illuminate\Http\Request;

class VanPhongController extends Controller
{
    public function index(Request $request)
    {
        $query = VanPhong::with('toaNha');

        if ($request->filled('ma_toa_nha')) {
            $query->where('ma_toa_nha', $request->ma_toa_nha);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('dien_tich_min')) {
            $query->where('dien_tich', '>=', $request->dien_tich_min);
        }

        if ($request->filled('dien_tich_max')) {
            $query->where('dien_tich', '<=', $request->dien_tich_max);
        }

        if ($request->filled('gia_thue_min')) {
            $query->where('gia_thue', '>=', $request->gia_thue_min);
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('gia_thue', '<=', $request->gia_thue_max);
        }

        $vanphongs = $query->get();
        $dsToaNha = ToaNha::orderBy('ten_toa_nha')->get();
        $title ="";

        return view('admin.vanphong.index', compact('vanphongs', 'dsToaNha','title'));
    }

    public function dathue(Request $request)
    {
        $query = VanPhong::with('toaNha')->where('trang_thai','da thue');

        if ($request->filled('ma_toa_nha')) {
            $query->where('ma_toa_nha', $request->ma_toa_nha);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('dien_tich_min')) {
            $query->where('dien_tich', '>=', $request->dien_tich_min);
        }

        if ($request->filled('dien_tich_max')) {
            $query->where('dien_tich', '<=', $request->dien_tich_max);
        }

        if ($request->filled('gia_thue_min')) {
            $query->where('gia_thue', '>=', $request->gia_thue_min);
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('gia_thue', '<=', $request->gia_thue_max);
        }

        $vanphongs = $query->get();
        $dsToaNha = ToaNha::orderBy('ten_toa_nha')->get();
        $title ="đã thuê";

        return view('admin.vanphong.index', compact('vanphongs', 'dsToaNha','title'));
    }

    public function dangxem(Request $request)
    {
        $query = HenXem::with('vanphong')->where('trang_thai','dang xu ly');

        if ($request->filled('ma_toa_nha')) {
            $query->where('ma_toa_nha', $request->ma_toa_nha);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('dien_tich_min')) {
            $query->where('dien_tich', '>=', $request->dien_tich_min);
        }

        if ($request->filled('dien_tich_max')) {
            $query->where('dien_tich', '<=', $request->dien_tich_max);
        }

        if ($request->filled('gia_thue_min')) {
            $query->where('gia_thue', '>=', $request->gia_thue_min);
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('gia_thue', '<=', $request->gia_thue_max);
        }
        $henxems = $query->get();
        foreach($henxems as $henxem){
            if (User::where('email', $henxem->email)->exists()) {
                $henxem->thongbao = null;
            } else {
                $henxem->thongbao = "Khách hàng chưa có tài khoản";
            }
            
        }
        $dsToaNha = ToaNha::orderBy('ten_toa_nha')->get();
        $title ="đang xem";

        return view('admin.vanphong.dangxem', [
            'henxems' => $henxems,
            'dsToaNha' => $dsToaNha,
            'title' => 'đang xem',
        ]);    
    }

    public function hethan(Request $request)
    {
        $query = VanPhong::with('toaNha')->where('trang_thai','het han hop dong');

        if ($request->filled('ma_toa_nha')) {
            $query->where('ma_toa_nha', $request->ma_toa_nha);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('dien_tich_min')) {
            $query->where('dien_tich', '>=', $request->dien_tich_min);
        }

        if ($request->filled('dien_tich_max')) {
            $query->where('dien_tich', '<=', $request->dien_tich_max);
        }

        if ($request->filled('gia_thue_min')) {
            $query->where('gia_thue', '>=', $request->gia_thue_min);
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('gia_thue', '<=', $request->gia_thue_max);
        }

        $vanphongs = $query->get();
        $dsToaNha = ToaNha::orderBy('ten_toa_nha')->get();
        $title ="hết hạn hợp đồng";

        return view('admin.vanphong.index', compact('vanphongs', 'dsToaNha','title'));
    }

    public function dangtrong(Request $request)
    {
        $query = VanPhong::with('toaNha')->where('trang_thai','dang trong');

        if ($request->filled('ma_toa_nha')) {
            $query->where('ma_toa_nha', $request->ma_toa_nha);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        if ($request->filled('dien_tich_min')) {
            $query->where('dien_tich', '>=', $request->dien_tich_min);
        }

        if ($request->filled('dien_tich_max')) {
            $query->where('dien_tich', '<=', $request->dien_tich_max);
        }

        if ($request->filled('gia_thue_min')) {
            $query->where('gia_thue', '>=', $request->gia_thue_min);
        }

        if ($request->filled('gia_thue_max')) {
            $query->where('gia_thue', '<=', $request->gia_thue_max);
        }

        $vanphongs = $query->get();
        $dsToaNha = ToaNha::orderBy('ten_toa_nha')->get();
        $title ="đang trống";

        return view('admin.vanphong.index', compact('vanphongs', 'dsToaNha','title'));
    }

    public function create()
    {
        $vanphongs = VanPhong::all();
        $toanhas = ToaNha::all();
        $nextId = VanPhong::max('ma_van_phong') + 1;
        return view('admin.vanphong.create', compact('vanphongs', 'toanhas', 'nextId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ten_van_phong' => 'required',
            'ma_toa_nha' => 'required',
            'dien_tich' => 'required|numeric',
            'gia_thue' => 'required|numeric',
            'mo_ta' => 'required|string',
            'tien_ich' => 'required|string',
            'trang_thai' => 'required',
            'images.*' => 'nullable|mimes:jpeg,png|max:2048',
        ]);

        $vanphong = VanPhong::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $vanphong->addMedia($image)
                    ->toMediaCollection('anh_van_phong');
            }
        }

        return response()->json([
            'message' => 'Thêm văn phòng thành công!',
            'next_id' => VanPhong::max('ma_van_phong') + 1
        ]);
    }

    public function edit($ma_van_phong)
    {
        $vanphong = VanPhong::with('media')->findOrFail($ma_van_phong);
        $toanhas = ToaNha::all();
        return view('admin.vanphong.edit', compact('vanphong', 'toanhas'));
    }

    public function update(Request $request, $ma_van_phong)
    {
        $vanphong = VanPhong::findOrFail($ma_van_phong);
        $request->merge([
            'gia_thue' => str_replace('.', '', $request->gia_thue)
        ]);
        $data = $request->validate([
            'ten_van_phong' => 'required',
            'ma_toa_nha' => 'required',
            'dien_tich' => 'required|numeric',
            'gia_thue' => 'required|numeric',
            'mo_ta' => 'required|string',
            'tien_ich' => 'required|string',
            'trang_thai' => 'required',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_images' => 'nullable|string',
        ]);

        $vanphong->update($data);

        if ($request->filled('deleted_images')) {
            $deletedImages = array_filter(explode(',', $request->input('deleted_images')));
            foreach ($deletedImages as $mediaId) {
                $media = $vanphong->getMedia('anh_van_phong')->where('id', $mediaId)->first();
                if ($media) {
                    $media->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $vanphong->addMedia($image)->toMediaCollection('anh_van_phong');
            }
        }

        return response()->json([
            'success' => 'Cập nhật văn phòng thành công',
            'data' => $vanphong,
        ]);
    }

    public function preview($id)
    {
        $vanphong = VanPhong::with('toanha')->findOrFail($id);
        return view('admin.vanphong.preview_vanphong', compact('vanphong'));
    }
}