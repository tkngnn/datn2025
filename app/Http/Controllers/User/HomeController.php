<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.layouts.app');
    }

    public function danhsach()
    {
        return view('user.home.danhsach');
    }
}