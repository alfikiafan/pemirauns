<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemira;

class PemiraController extends Controller
{
    public function index()
    {
        $pemira = Pemira::all();
        return view('pemira.index', compact('pemira'));
    }

    public function create()
    {
        return view('pemira.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'facculty' => 'required|string|max:255',
            'year' => 'required|integer',
            'information' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Pemira::create($request->all());

        return redirect()->route('pemira.index')->with('success', 'Pemira created successfully.');
    }

    public function show($id)
    {
        $pemira = Pemira::findOrFail($id);
        return view('pemira.show', compact('pemira'));
    }

    public function edit($id)
    {
        $pemira = Pemira::findOrFail($id);
        return view('pemira.edit', compact('pemira'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'facculty' => 'required|string|max:255',
            'year' => 'required|integer',
            'information' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pemira = Pemira::findOrFail($id);
        $pemira->update($request->all());

        return redirect()->route('pemira.index')->with('success', 'Pemira updated successfully.');
    }

    public function destroy($id)
    {
        $pemira = Pemira::findOrFail($id);
        $pemira->delete();

        return redirect()->route('pemira.index')->with('success', 'Pemira deleted successfully.');
    }
}