<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VanPhong;
use App\Models\HenXem;

use Illuminate\Http\Request;

class VanPhongController extends Controller
{
    public function show($slug)
    {
        $vanphong = VanPhong::with('toaNha')->where('slug', $slug)->firstOrFail();

        return view('user.home.chitiet', compact('vanphong'));
    }

    public function henxem($slug)
    {
        $vanphong = VanPhong::with('toaNha')->where('slug', $slug)->firstOrFail();

        return view('user.home.henxem', compact('vanphong'));
    }

    public function guiyeucau(Request $request)
    {
        $data = $request->validate([
        'ma_van_phong' => 'required|exists:van_phong,ma_van_phong',
        'ho_ten' => 'required|string|max:255',
        'email' => 'required|email',
        'sdt' => 'required|string|max:15',
        'ngay_hen' => 'required|date|after:now',
        'ghi_chu' => 'nullable|string',
    ]);

    $data['trang_thai'] = 'chua xu ly';
    HenXem::create($data);

    return response()->json(['message' => 'Đã gửi yêu cầu hẹn xem thành công.']);
    }
}
