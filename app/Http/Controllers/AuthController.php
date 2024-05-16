<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect ke dashboard berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'candidate') {
                return redirect()->route('candidate.dashboard');
            } elseif ($user->role === 'voter') {
                return redirect()->route('user.dashboard');
            } else {
                // Jika role tidak dikenali, redirect ke dashboard umum
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'student_card' => 'required|image|max:2048',
            'user_photo_data' => 'required', 
        ]);
    
        $studentCardPath = $request->file('student_card')->store('public/student_cards');
    
        $userPhotoData = $request->input('user_photo_data');
        $userPhoto = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $userPhotoData));
        $userPhotoPath = 'public/user_photos/' . uniqid() . '.jpg';
    
        Storage::put($userPhotoPath, $userPhoto);

        $user = User::create([
            'name' => $request->input('name'),
            'nim' => $request->input('nim'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'student_card' => $studentCardPath,
            'user_photo' => $userPhotoPath,
        ]);

        // Setelah registrasi, langsung login dan redirect ke dashboard
        Auth::login($user);

        // Redirect ke dashboard berdasarkan role (default: user)
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'candidate') {
            return view('candidate.dashboard');
        } elseif ($user->role === 'voter') {
            return view('user.dashboard');
        } else {
            // Jika role tidak dikenali, redirect ke dashboard umum
            return view('dashboard');
        }
    }
}
