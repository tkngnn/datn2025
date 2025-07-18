<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use App\Models\KhachHang;
use App\Models\HenXem;
use App\Models\HopDong;
use App\Models\User;

class KhachHangController extends Controller
{
    public function index(Request $request)
    {
        $query = KhachHang::query();

        if ($request->filled('vai_tro')) {
            $query->where('vai_tro', $request->vai_tro);
        }

        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $khachhangs = $query->get();

        return view('admin.khachhang.index', compact('khachhangs'));
    }

    public function create($id = null)
    {
        $nextId = KhachHang::max('id') + 1;
        $khachhang = null;
        $henxem = null;
        if($id){
            $khachhang=HenXem::where('ma_hen_xem',$id)->first();
            $henxem = $id;
        }
        return view('admin.khachhang.create',compact('nextId','khachhang','henxem'));
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

        if (!empty($request->henxem_id)) {
            $henxem = HenXem::find($request->henxem_id);
            Log::info('Email cần tìm: ' . $henxem->email);
            $khachhang = User::where('email',$henxem->email)->first();
            Log::info('Khách hàng tìm được: ' . ($khachhang ? $khachhang->email : 'Không có'));
            if ($henxem) {
                //$henxem->trang_thai = 'da xu ly';
                //$vanphong = $henxem->ma_van_phong;
                //$henxem->save();

                return response()->json([
                    'success' => true,
                    'nextId' => $nextId,
                    'redirect_url' => route('admin.vanphong.dangxem'),
                    'khachhang' => $khachhang->email ?? null,
                    'message' => 'Tạo tài khoản thành công từ lịch hẹn xem',
                ]);
            }
        }

        return response()->json(['success' => true, 'nextId' => $nextId]);
    }

    public function edit($id)
    {
        $khachhang = KhachHang::findOrFail($id);
        $hopdongs=HopDong::where('user_id',$id)
        ->whereIn('tinh_trang',['dang thue','da ky', 'da lap'])
        ->count();
        return view('admin.khachhang.edit', compact('khachhang','hopdongs'));
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
