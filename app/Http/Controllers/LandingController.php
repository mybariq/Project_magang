<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    /**
     * Menampilkan landing page untuk pengguna mengajukan pengaduan.
     */
    public function index(Request $request): View
    {
        return view('landing');
    }
}
