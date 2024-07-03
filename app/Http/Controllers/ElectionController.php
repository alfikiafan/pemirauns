<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Election;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::paginate(10);
        View::share('showSearchBox', true);

        $search = request()->query('search');

        if ($search) {
            $elections = Election::where('name', 'LIKE', "%{$search}%")
                ->orWhere('faculty', 'LIKE', "%{$search}%")
                ->orWhere('start_date', 'LIKE', "%{$search}%")
                ->orWhere('end_date', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->paginate(10);
        }

        return view('admin.election.index', ['elections' => $elections]);
    }

    public function create()
    {
        return view('admin.election.create');  
    }

    public function store(Request $request){
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

    public function view($id)
    {
        $election = Election::find($id);
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
        // apabila terdapat data yang terkait dengan election, maka akan ada error
        if ($election->candidates->count() > 0) {
            return redirect()->route('admin.election')->withErrors('Election cannot be deleted because it has candidates');
        }
        else{
            $election->delete();
            return redirect()->route('admin.election')->with('success', 'Election deleted successfully');
        }
    }
}
