<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\KhachHang;

class KhachHangController extends Controller
{
    public function index()
    {
        $khachhangs = KhachHang::all();
        return view('admin.khachhang.index', compact('khachhangs'));
    }

    public function create()
    {
        $nextId = KhachHang::max('id') + 1;
        return view('admin.khachhang.create',compact('nextId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'so_dien_thoai' => 'nullable',
            'dia_chi' => 'nullable',
            'cccd' => 'required',
            'vai_tro' => 'required',
            'trang_thai' => 'required',
        ]);

        $data['password'] = Hash::make($data['cccd']);

        KhachHang::create($data);
        $nextId = KhachHang::max('id') + 1;

        return response()->json(['success' => true, 'nextId' => $nextId]);
    }

    public function edit($id)
    {
        $khachhang = KhachHang::findOrFail($id);
        return view('admin.khachhang.edit', compact('khachhang'));
    }

    public function update(Request $request, $id)
    {   
        $khachhang = KhachHang::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $khachhang->id . ',id',
            'password' => 'nullable|string|min:6|confirmed',
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string|max:255',
            'cccd' => 'required|string|max:20',
            'vai_tro' => 'required|string|max:50',
            'trang_thai' => 'required|boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $khachhang->update($data);

        return response()->json([
            'data' => $khachhang,
            ]);    
    }

}
