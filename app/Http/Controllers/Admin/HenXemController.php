<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\HenXemSendMailer;
use Illuminate\Support\Facades\Mail;

use App\Models\VanPhong;
use App\Models\HenXem;
use App\Models\User;

class HenXemController extends Controller
{
    public function index(Request $request)
    {
        $query = HenXem::with('vanphong');
        if ($request->filled('trang_thai')) {
                $query->where('trang_thai', $request->trang_thai);
            }
        $query->orderByRaw("CASE WHEN trang_thai = 'chua xu ly' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc');

        $henxems=$query->get();
        foreach($henxems as $henxem){
            if(User::where('email', $henxem->email)->exists())
            $henxem->thongbao ="Khách hàng đã có tài khoản";
        }

        return view('admin.henxem.index', compact('henxems'));
    }

    public function edit($id)
    {
        $henxem = HenXem::findOrFail($id);
        return view('admin.henxem.edit', compact('henxem'));
    }

    public function update(Request $request, $id)
    {
        $henxem = HenXem::with('vanphong')->findOrFail($id);
        $henxem->trang_thai = 'dang xu ly';
        $henxem->save();

        $vanphong = VanPhong::where('ma_van_phong', $henxem->ma_van_phong)->first();
        if ($vanphong) {
            $vanphong->trang_thai = 'dang xem';
            $vanphong->save();
        }
        Mail::to($henxem->email)->send(new HenXemSendMailer($henxem));

        return redirect()->route('admin.henxem.index')->with('success', 'Cập nhật trạng thái lịch hẹn xem thành công');
    }

    public function khachdadangki($id)
    {
        $henxem = HenXem::findOrFail($id);
        //$henxem->trang_thai = 'da xu ly';
        //$henxem->save();

        $khachhang = User::where('email', $henxem->email)->first();

        return redirect()->route('admin.vanphong.dangxem',['khachhang'=> $khachhang->email]);
    }
}