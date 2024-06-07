<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
            $user = Auth::user();

            $roles = $user->roles->pluck('name')->toArray();

            if (in_array('superadmin', $roles) || in_array('admin_univ', $roles) || in_array('admin_fakultas', $roles)) {
                return redirect()->route('admin.dashboard');
            }

            if (empty($roles)) {
                if ($user->user_status === 'approved') {
                    return redirect()->route('user.dashboard');
                } elseif (is_null($user->user_status)) {
                    Auth::logout();
                    return redirect()->back()->withInput()->withErrors(['email' => 'Your account is still under validation. Please wait for the approval.']);
                }
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'batch' => ['required', 'integer'],
            'faculty' => ['required', 'string', 'max:255'],
            'student_card' => 'required|image|max:2048',
            'user_photo_data' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'batch' => $request->batch,
            'faculty' => $request->faculty,
            'student_card' => $studentCardPath,
            'user_photo' => $userPhotoPath,
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}