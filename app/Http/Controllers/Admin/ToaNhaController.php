<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToaNha;

class ToaNhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ToaNha::withCount('vanPhongs');
        
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $dsToaNha = $query->paginate(10);

        return view('admin.toanha.index', compact('dsToaNha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.toanha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'floor_count' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'trang_thai' => 'required|in:hoat dong, khong hoat dong',
        ]);

        ToaNha::create([
            'ten_toa_nha' => $request->building_name,
            'dia_chi' => $request->address,
            'so_tang' => $request->floor_count,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => $request->trang_thai,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.toanha.index')->with('success', 'Tạo tòa nhà thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $toaNha = ToaNha::findOrFail($id);
        return view('admin.toanha.show', compact('toaNha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $toaNha = ToaNha::findOrFail($id);
            $vanPhongDangThue = $toaNha->vanPhongs()
            ->whereIn('trang_thai',['dang xem','da thue','cho ban giao'])
            ->count();
            return view('admin.toanha.edit', compact('toaNha','vanPhongDangThue'));
    }

    public function update(Request $request, string $id)
    {
        $trangThai = ToaNha::where('ma_toa_nha', $id)->value('trang_thai');
        $request->validate([
            'building_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'floor_count' => 'required|integer|min:1',
            'mo_ta' => 'nullable|string',
            'trang_thai' => 'required|in:hoat dong,khong hoat dong',
        ]);

        $toanha = ToaNha::findOrFail($id);
        $toanha->update([
            'ten_toa_nha' => $request->building_name,
            'dia_chi' => $request->address,
            'so_tang' => $request->floor_count,
            'mo_ta' => $request->mo_ta,
            'trang_thai' => $request->trang_thai,
        ]);

        if($request->trang_thai == 'khong hoat dong')
        {
            $dsVanPhong = $toanha->vanPhongs;
            foreach($dsVanPhong as $vanphong)
            {
                $vanphong->trang_thai='khong hoat dong';
                $vanphong->save();
            }
        }

        if($request->trang_thai == 'hoat dong' && $trangThai == 'khong hoat dong')
        {
            $dsVanPhong = $toanha->vanPhongs;
            foreach($dsVanPhong as $vanphong)
            {
                $vanphong->trang_thai='dang trong';
                $vanphong->save();
            }
        }
        return redirect()->route('admin.toanha.index')->with('success', 'Cập nhật tòa nhà thành công.');
    }

    /**
     * Chỉ cập nhật trạng thái, không xóa khỏi DB.
     */
    public function destroy(string $id)
    {
        $toaNha = ToaNha::findOrFail($id);
        $toaNha->update(['trang_thai' => 'khong hoat dong']);
        $toaNha->delete(); 
        return redirect()->route('admin.toanha.index')->with('success', 'Đã cập nhật trạng thái xóa.');
    }

    public function preview($id)
    {
        $toaNha = ToaNha::findOrFail($id);
        return view('admin.toanha.preview_toanha', compact('toaNha'));
    }

}