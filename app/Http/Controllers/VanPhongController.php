<?php

namespace App\Http\Controllers;

use App\Models\VanPhong;
use App\Models\ToaNha;
use Illuminate\Http\Request;

class VanPhongController extends Controller
{
    public function index()
    {
        $vanphongs = VanPhong::with('toaNha')->get();
        return view('admin.vanphong.index', compact('vanphongs'));
    }

    public function create()
    {
        $vanphongs = VanPhong::all();
        $toanhas = ToaNha::all();
        $nextId = VanPhong::max('ma_van_phong') + 1;
        return view('admin.vanphong.create', compact('vanphongs','toanhas','nextId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ten_van_phong'=>'required',
            'ma_toa_nha' => 'required',
            'dien_tich' => 'required|numeric',
            'gia_thue' => 'required|numeric',
            'mo_ta' => 'required|string',
            'tien_ich' => 'required|string',
            'trang_thai' => 'required',
        ]);

        VanPhong::create($data);
        return redirect()->route('admin.vanphong.index')->with('success', 'Thêm văn phòng thành công');
    }

    public function edit($ma_van_phong)
    {
        //dd($ma_van_phong);
        $vanphong = VanPhong::findOrFail($ma_van_phong);
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
            'ten_van_phong'=>'required',
            'ma_toa_nha' => 'required',
            'dien_tich' => 'required|numeric',
            'gia_thue' => 'required|numeric',
            'mo_ta' => 'required|string',
            'tien_ich' => 'required|string',
            'trang_thai' => 'required',
        ]);

        $vanphong->update($data);
        return redirect()->route('admin.vanphong.index');
        return response()->json([
            'success'=> 'Cập nhật văn phòng thành công',
            'data' => $vanphong,
            ]);
    }
}