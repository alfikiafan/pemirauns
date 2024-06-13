<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Mail\UserRejected;
use Illuminate\Support\Facades\Mail;

class VoterController extends Controller
{
    public function index(Request $request)
    {
        $superadminRoleId = Role::where('name', 'superadmin')->first()->id;

        $query = User::whereDoesntHave('roles', function($query) use ($superadminRoleId) {
            $query->where('role_id', $superadminRoleId);
        });

        $filter = $request->input('filter');
        $query->when($filter == 'not_approved', function ($query) {
            $query->where('user_status', '!=', 'approved')->orWhereNull('user_status');
        });
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users', 'filter'));
    }
    

    public function updateAccountStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'user_status' => 'required|in:approved,rejected'
        ]);

        $user = User::find($request->user_id);

        if ($request->user_status == 'rejected') {
            Mail::to($user->email)->send(new UserRejected($user));
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User account has been rejected and deleted successfully.');
        } else {
            $user->user_status = $request->user_status; 
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'User status updated successfully.');
        }
    }
}