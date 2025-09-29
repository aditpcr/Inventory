<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(string $param1)
    {
        if ($param1 == 'login') {
            return view('halaman-loginAdmin');
        } elseif ($param1 == 'profil') {
            return view('halaman-dashboardAdmin');
        } else {
            return "Halaman tidak ditemukan";
        }
    }
}
