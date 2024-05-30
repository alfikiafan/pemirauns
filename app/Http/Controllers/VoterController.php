<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class VoterController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', 'superadmin')->first()->id;
        $users = User::whereDoesntHave('roles', function($query) use ($roles) {
            $query->where('role_id', $roles);
        })->get();

        return view('admin.manage_user', compact('users'));
    }

    public function updateAccountStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_status' => 'required|in:approved,rejected'
        ]);
        
        $user = User::find($request->user_id);

        if ($request->user_status == 'rejected') {
            $user->delete();
    
            return redirect()->route('admin.manage_user')->with('success', 'User account has been rejected and deleted successfully.');
        } else {
            $user->user_status = $request->user_status; 
            $user->save();
    
            return redirect()->route('admin.manage_user')->with('success', 'User status updated successfully.');
        }

    }
}