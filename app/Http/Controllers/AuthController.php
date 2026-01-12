<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if admin credentials
        if ($request->email === 'admin@studentresult.com' && $request->password === 'admin123') {
            // Create admin session
            session(['is_admin' => true, 'admin_email' => $request->email]);
            return redirect()->route('admin.dashboard');
        }

        // Try student login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        // Clear admin session if exists
        if (session('is_admin')) {
            session()->forget(['is_admin', 'admin_email']);
        } else {
            Auth::logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}