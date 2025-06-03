<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\YeuCauHoTro;
use App\Models\User;
use Illuminate\Support\Carbon;

class HoTroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yeuCaus = YeuCauHoTro::with('user')->get();
        return view('admin.hotro.index', compact('yeuCaus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $yeuCau = YeuCauHoTro::with('user')->findOrFail($id);
        return view('admin.hotro.show', compact('yeuCau'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $yeuCau = YeuCauHoTro::findOrFail($id);
        return view('admin.hotro.edit', compact('yeuCau'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'trang_thai_xu_ly' => 'required|string|max:50',
            'ghi_chu_xu_ly' => 'nullable|string',
        ]);

        $yeuCau = YeuCauHoTro::findOrFail($id);
        $yeuCau->update($request->only(['trang_thai_xu_ly', 'ghi_chu_xu_ly']));

        return redirect()->route('admin.hotro.index')->with('success', 'Cập nhật xử lý thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $yeuCau = YeuCauHoTro::findOrFail($id);
        $yeuCau->delete();

        return redirect()->route('hotro.index')->with('success', 'Đã xóa yêu cầu.');
    }
}