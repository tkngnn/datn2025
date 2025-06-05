<?php

namespace App\Http\Controllers\Admin\KT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\HopDong;
use App\Models\HoaDon;


class KTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        Log::info('User accessed KT index', ['user_id' => $user->id, 'user_name' => $user->name]);

        return view('admin.kt.index', compact('user'));
    }

    public function DSHopDong()
    {
        $user = Auth::user();
        $hopDongs = HopDong::where('user_id', $user->id)->get();

        return view('admin.kt.dshopdong', compact('hopDongs'));
    }
    public function DSHoaDon()
    {
        $user = Auth::user();

        $hoaDons = HoaDon::whereHas('hopDong', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->orderByRaw("CASE WHEN trang_thai = 'chua thanh toan' THEN 0 ELSE 1 END") 
            ->orderByDesc('thang_nam')
            ->get();

        return view('admin.kt.dshoadon', compact('hoaDons'));
    }
    
}