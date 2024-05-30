<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class AdminUnivController extends Controller
{
    public function manageAdminUniv()
    {
        // Get all admin_univ users
        $adminUnivRole = Role::where('name', 'admin_univ')->first();
        $adminUnivs = $adminUnivRole ? $adminUnivRole->users : collect();

        // Get users without any role
        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        return view('admin.manage_admin_univ', compact('adminUnivs', 'usersWithoutRole'));
    }

    public function addAdminUniv(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser->hasRole('superadmin')) {
            return back()->withErrors(['Unauthorized action.']);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $role = Role::where('name', 'admin_univ')->first();

        if ($user->hasRole('admin_univ')) {
            return back()->withErrors(['User is already an admin_univ']);
        }

        $user->roles()->attach($role->id);

        return redirect()->route('admin.manage_admin_univ')->with('success', 'User promoted to admin_univ');
    }

    public function removeAdminUniv(Request $request, $userId)
    {
        $currentUser = Auth::user();
        if (!$currentUser->hasRole('superadmin')) {
            return back()->withErrors(['Unauthorized action.']);
        }

        $user = User::find($userId);
        $role = Role::where('name', 'admin_univ')->first();

        if (!$user->hasRole('admin_univ')) {
            return back()->withErrors(['User is not an admin_univ']);
        }

        $user->roles()->detach($role->id);

        return redirect()->route('admin.manage_admin_univ')->with('success', 'User demoted from admin_univ');
    }
}