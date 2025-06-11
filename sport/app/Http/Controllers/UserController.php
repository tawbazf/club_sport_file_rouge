<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id()); // Get user from database directly
            if ($user) {
                $user->last_login_at = now();
                $user->save();
            }

            // Role-based redirection
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin/reports'); // Or route('admin.dashboard')
                case 'coach':
                    return redirect()->intended('/coach/sessions'); // Or route('coach.dashboard')
                case 'member':
                    return redirect()->intended('/member/classes');  // Or route('member.dashboard')
                default:
                    return redirect()->intended('/home'); // Fallback redirect
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // Redirect back with error for web form
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,coach,member',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);}

      
    public function logout(Request $request)
    {
       Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect('/login'); 
    }
    
}