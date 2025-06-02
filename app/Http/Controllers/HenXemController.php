<?php

namespace App\Http\Controllers;

use App\Models\VanPhong;
use App\Models\HenXem;
use Illuminate\Http\Request;

class HenXemController extends Controller
{
    public function index()
    {
        $henxems = HenXem::with('vanphong')->get();
        return view('admin.henxem.index', compact('henxems'));
    }

    public function edit($id)
    {
        $henxem = HenXem::findOrFail($id);
        return view('admin.henxem.edit', compact('henxem'));
    }

    public function update(Request $request, $id)
    {
        $henxem = HenXem::findOrFail($id);
        $henxem->trang_thai = 'Da hoan thanh';
        $henxem->save();

        return redirect()->route('admin.henxem.index')->with('success', 'Cập nhật lịch hẹn xem thành công');
    }
}
