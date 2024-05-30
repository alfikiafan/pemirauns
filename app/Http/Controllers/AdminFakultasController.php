<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AdminFakultasController extends Controller
{
    public function manageAdminFakultas()
    {
        $adminFakultasRole = Role::where('name', 'admin_fakultas')->first();
        $adminFakuls = $adminFakultasRole ? $adminFakultasRole->users : collect();

        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        $faculties = [
            'FMIPA', 'FATISDA', 'FEB', 'FISIP', 'FT', 'FSRD', 'FK', 'FH', 'FKIP', 'FIB', 'FP', 'Psikologi', 'FKO'
        ];

        return view('admin.manage_admin_fakultas', compact('adminFakuls', 'usersWithoutRole', 'faculties'));
    }

    public function addAdminFakultas(Request $request)
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

        return redirect()->route('admin.manage_admin_fakultas')->with('success', 'User promoted to admin_fakultas');
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

        return redirect()->route('admin.manage_admin_fakultas')->with('success', 'User demoted from admin_fakultas');
    }
}