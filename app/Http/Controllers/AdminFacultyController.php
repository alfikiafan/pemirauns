<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Role;

class AdminFacultyController extends Controller
{
    public function index()
    {
        $adminFakultasRole = Role::where('name', 'admin_fakultas')->first();
        $adminFakuls = $adminFakultasRole ? $adminFakultasRole->users() : collect();

        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        View::share('showSearchBox', true);
        $search = request()->query('search');

        if ($search) {
            $adminFakuls = $adminFakuls->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('roles', function($query) use ($search) {
                            $query->where('faculty', 'LIKE', '%' . $search . '%');
                        })
                        ->orWhere('nim', 'LIKE', '%' . $search . '%');
                })
                ->with(['roles' => function($query) use ($search) {
                    $query->where('faculty', 'LIKE', '%' . $search . '%');
                }])
                ->paginate(10);
        } else {
            $adminFakuls = $adminFakuls->paginate(10);
        }

        $adminFakuls->appends(['search' => $search]);

        return view('admin.admin_faculty.index', compact('adminFakuls', 'usersWithoutRole'));
    }

    public function create()
    {
        $faculties = [
            'FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRD', 'FK', 'FH', 'FKIP', 'FIB', 'FP', 'Psikologi', 'FKO'
        ];

        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        return view('admin.admin_faculty.create', compact('faculties', 'usersWithoutRole'));
    }

    public function store(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser->hasRole('superadmin')) {
            return back()->withErrors(['Unauthorized action.']);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'faculty' => 'required|in:FMIPA,FATISDA,FEB,FISIP,FT,FSRD,FK,FH,FKIP,FIB,FP,Psikologi,FKO',
        ]);

        $user = User::find($request->user_id);
        $role = Role::where('name', 'admin_fakultas')->first();

        if ($user->hasRole('admin_fakultas')) {
            return back()->withErrors(['User is already an admin_fakultas']);
        }

        $user->roles()->attach($role->id, ['faculty' => $request->faculty]);

        return redirect()->route('admin.admin_faculty.index')->with('success', 'User promoted to admin_fakultas');
    }

    public function removeAdminFakultas(Request $request, $userId)
    {
        $currentUser = Auth::user();
        if (!$currentUser->hasRole('superadmin')) {
            return back()->withErrors(['Unauthorized action.']);
        }

        $user = User::find($userId);
        $role = Role::where('name', 'admin_fakultas')->first();

        if (!$user->hasRole('admin_fakultas')) {
            return back()->withErrors(['User is not an admin_fakultas']);
        }

        $user->roles()->detach($role->id);

        return redirect()->route('admin.admin_faculty.index')->with('success', 'User demoted from admin_fakultas');
    }
}