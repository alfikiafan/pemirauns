<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('admin.manage_election', ['elections' => $elections]);
    }

    public function create(Request $request)
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

        return redirect()->route('admin.manage_election')->with('success', 'Election created successfully');
    }

    public function delete($id)
    {
        $election = Election::find($id);
        $election->delete();

        return redirect()->route('admin.manage_election')->with('success', 'Election deleted successfully');
    }
}
