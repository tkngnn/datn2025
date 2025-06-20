<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VanPhong;
use App\Models\ToaNha;
use Illuminate\Http\Request;

class VanPhongController extends Controller
{
    public function index()
    {
        $vanphongs = VanPhong::with('toanha')->get();
        return view('admin.vanphong.index', compact('vanphongs'));
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
        //dd($ma_van_phong);
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
}