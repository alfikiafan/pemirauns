<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Election;

class ElectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $electionsQuery = Election::query();

        if ($user && $user->hasRole('admin_fakultas')) {
            $electionsQuery->where('faculty', $user->faculty);
        }

        $search = request()->query('search');
        if ($search) {
            $electionsQuery->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('faculty', 'LIKE', "%{$search}%")
                    ->orWhere('start_date', 'LIKE', "%{$search}%")
                    ->orWhere('end_date', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $elections = $electionsQuery->paginate(10);
        View::share('showSearchBox', true);

        return view('admin.election.index', ['elections' => $elections]);
    }

    public function create()
    {
        return view('admin.election.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $election = Election::create([
            'name' => $request->name,
            'faculty' => $request->faculty,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.election')->with('success', 'Election created successfully');
    }

    public function edit($id)
    {
        $election = Election::find($id);

        if (!$election) {
            return redirect()->route('admin.election')->withErrors('Election not found');
        }

        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas') && $election->faculty != $user->faculty) {
            return redirect()->route('admin.election')->withErrors('You do not have permission to edit this election');
        }

        return view('admin.election.edit', ['election' => $election]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string',
        ]);

        $election = Election::find($id);

        if (!$election) {
            return redirect()->route('admin.election')->withErrors('Election not found');
        }

        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas') && $election->faculty != $user->faculty) {
            return redirect()->route('admin.election')->withErrors('You do not have permission to update this election');
        }

        $election->name = $request->name;
        $election->faculty = $request->faculty;
        $election->start_date = $request->start_date;
        $election->end_date = $request->end_date;
        $election->description = $request->description;
        $election->save();

        return redirect()->route('admin.election')->with('success', 'Election updated successfully');
    }

    public function delete($id)
    {
        $election = Election::find($id);

        if (!$election) {
            return redirect()->route('admin.election')->withErrors('Election not found');
        }

        $user = Auth::user();
        if ($user && $user->hasRole('admin_fakultas') && $election->faculty != $user->faculty) {
            return redirect()->route('admin.election')->withErrors('You do not have permission to delete this election');
        }

        if ($election->candidates()->exists()) {
            return redirect()->route('admin.election')->withErrors('Election cannot be deleted because it has candidates');
        } else {
            $election->delete();
            return redirect()->route('admin.election')->with('success', 'Election deleted successfully');
        }
    }
}
