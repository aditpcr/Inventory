<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display the unified login form
     */
    public function index()
    {
        return view('login-form');
    }

    /**
     * Handle login form submission for all roles
     */
    public function login(Request $request)
    {
        // Validate role selection
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:admin,supervisor,employee',
            'username' => 'required',
            'password' => 'required',
        ], [
            'role.required' => 'Pilih role terlebih dahulu!',
            'role.in' => 'Role tidak valid!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = $request->role;
        $username = $request->username;
        $password = $request->password;

        // Route based on role
        switch ($role) {
            case 'admin':
                return $this->handleAdminLogin($username, $password);
            
            case 'supervisor':
                return $this->handleSupervisorLogin($username, $password);
            
            case 'employee':
                return $this->handleEmployeeLogin($username, $password);
            
            default:
                return redirect()->back()->with('error', 'Role tidak valid!')->withInput();
        }
    }

    /**
     * Handle admin login
     */
    private function handleAdminLogin($username, $password)
    {
        $validator = Validator::make([
            'username' => $username,
            'password' => $password
        ], [
            'username' => 'required',
            'password' => [
                'required',
                'min:3',
                'regex:/[A-Z]/'
            ],
        ], [
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 3 karakter!',
            'password.regex' => 'Password harus mengandung huruf kapital!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('role', 'admin');
        }

        // Admin credentials
        $admin = [
            'username' => 'admin123',
            'password' => 'Admin123',
        ];

        if ($username === $admin['username'] && $password === $admin['password']) {
            session([
                'admin_logged_in' => true,
                'user_role' => 'admin'
            ]);
            return redirect('/admin/dashboard')->with('success', 'Login berhasil! Selamat datang, admin.');
        }

        return redirect()->back()->with('error', 'Username atau Password salah!')->withInput()->with('role', 'admin');
    }

    /**
     * Handle supervisor login
     */
    private function handleSupervisorLogin($username, $password)
    {
        $validator = Validator::make([
            'username' => $username,
            'password' => $password
        ], [
            'username' => [
                'required',
                'string',
                'regex:/^[a-z]+$/',
                'max:255'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
            ]
        ], [
            'username.regex' => 'Username tidak boleh memiliki huruf besar, spasi dan angka',
            'password.regex' => 'Password wajib memiliki huruf dan angka.',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('role', 'supervisor');
        }

        // Supervisor credentials
        $allowedUsername = 'adityadfn'; 
        $allowedPassword = 'abcdefgh123'; 

        if ($username !== $allowedUsername || $password !== $allowedPassword) {
            return redirect()->back()->with('error', 'Tolong cek ulang password dan username yang di inputkan')->withInput()->with('role', 'supervisor');
        }

        session([
            'supervisor_logged_in' => true,
            'user_role' => 'supervisor',
            'username' => $username
        ]);

        return redirect('/supervisor/dashboard')->with('success', 'Login berhasil! Selamat datang, supervisor.');
    }

    /**
     * Handle employee login
     */
    private function handleEmployeeLogin($username, $password)
    {
        $validator = Validator::make([
            'username' => $username,
            'password' => $password
        ], [
            'username' => 'required',
            'password' => ['required', 'min:8'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('role', 'employee');
        }

        // Employee credentials
        if ($username === '2455301159' && $password === '2455301159') {
            session([
                'employee_logged_in' => true,
                'user_role' => 'employee'
            ]);
            return redirect('/employee/dashboard')->with('success', 'Login berhasil! Selamat datang Employee Kece😎.');
        }

        return redirect()->back()->with('error', 'Username atau Passwordmu salah😭')->withInput()->with('role', 'employee');
    }

    /**
     * Admin Dashboard
     */
    public function adminDashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin-dashboard');
    }

    /**
     * Supervisor Dashboard
     */
    public function supervisorDashboard()
    {
        if (!session('supervisor_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('supervisor-dashboard', ['username' => session('username')]);
    }

    /**
     * Employee Dashboard
     */
    public function employeeDashboard()
    {
        if (!session('employee_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('employee-dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        $role = session('user_role');
        
        session()->flush();
        
        return redirect('/login')->with('success', "Logout berhasil! Sampai jumpa {$role}.");
    }
}