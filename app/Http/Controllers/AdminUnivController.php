<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Role;

class AdminUnivController extends Controller
{
    public function index()
    {
        $adminUnivRole = Role::where('name', 'admin_univ')->first();
        $adminUnivs = $adminUnivRole ? $adminUnivRole->users() : collect();

        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        View::share('showSearchBox', true);
        $search = request()->query('search');

        if ($search) {
            $adminUnivs = $adminUnivs->where(function($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('nim', 'LIKE', '%' . $search . '%');
                })
                ->paginate(10);
        } else {
            $adminUnivs = $adminUnivs->paginate(10);
        }

        return view('admin.admin_univ.index', compact('adminUnivs', 'usersWithoutRole'));
    }

    public function create()
    {
        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        return view('admin.admin_univ.create', compact('usersWithoutRole'));
    }

    public function store(Request $request)
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

        $user->roles()->attach($role->id, ['faculty' => 'Univ']);

        return redirect()->route('admin.admin_univ.index')->with('success', 'User promoted to admin_univ');
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

        return redirect()->route('admin.admin_univ.index')->with('success', 'User demoted from admin_univ');
    }
}