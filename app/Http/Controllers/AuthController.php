<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
            return redirect()->intended('/dashboard');
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
    
        $studentCardsPath = public_path('images/student_cards');
        $userPhotosPath = public_path('images/user_photos');
    
        if (!File::exists($studentCardsPath)) {
            File::makeDirectory($studentCardsPath, 0755, true);
        }
    
        if (!File::exists($userPhotosPath)) {
            File::makeDirectory($userPhotosPath, 0755, true);
        }
    
        $studentCard = $request->file('student_card');
        $studentCardFilename = uniqid() . '.' . $studentCard->getClientOriginalExtension();
        $studentCard->move($studentCardsPath, $studentCardFilename);
        $studentCardPath = 'images/student_cards/' . $studentCardFilename;
    
        $userPhotoData = $request->input('user_photo_data');
        $userPhoto = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $userPhotoData));
        $userPhotoFilename = uniqid() . '.jpg';
        $userPhotoFullPath = $userPhotosPath . '/' . $userPhotoFilename;
        File::put($userPhotoFullPath, $userPhoto);
        $userPhotoPath = 'images/user_photos/' . $userPhotoFilename;
    
        $user = User::create([
            'name' => $request->input('name'),
            'nim' => $request->input('nim'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'student_card' => $studentCardPath,
            'user_photo' => $userPhotoPath,
        ]);
    
        return redirect('/');
    } 
    

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
}