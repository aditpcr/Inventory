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

    public function index()
    {
        // List of admins with random ages between 18 - 29
        $admins = [
            [
                'name' => 'Adityadfn',
                'age' => rand(18, 29),
                'hobbies' => ['Gym', 'Berenang', 'Tidur'],
                'future_goal' => 'Menjadi Fullstack Developer',
            ],
            [
                'name' => 'Cherryn',
                'age' => rand(18, 29),
                'hobbies' => ['Membaca', 'Jalan-jalan', 'Gaming'],
                'future_goal' => 'Punya Startup sendiri',
            ],
            [
                'name' => 'Marwan',
                'age' => rand(18, 29),
                'hobbies' => ['Ngoding', 'Nonton Film'],
                'future_goal' => 'Software Engineer di luar negeri',
            ],
            [
                'name' => 'Juwan',
                'age' => rand(18, 29),
                'hobbies' => ['Olahraga', 'Main Musik'],
                'future_goal' => 'Menjadi Investor',
            ],
            [
                'name' => 'Joceline',
                'age' => rand(18, 29),
                'hobbies' => ['Traveling', 'Masak'],
                'future_goal' => 'Content Creator sukses',
            ],
        ];

        return view('admin', [
            'admins' => $admins,
        ]);
    }
}
