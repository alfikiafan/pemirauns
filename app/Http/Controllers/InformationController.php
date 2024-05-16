<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Auth;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::all();
        return view('informations.index', compact('informations'));
    }

    public function create()
    {
        return view('informations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'publish_date' => 'required|date',
        ]);

        Information::create([
            'admin_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
        ]);

        return redirect()->route('informations.index')->with('success', 'Information created successfully.');
    }

    public function show($id)
    {
        $information = Information::findOrFail($id);
        return view('informations.show', compact('information'));
    }

    public function edit($id)
    {
        $information = Information::findOrFail($id);
        return view('informations.edit', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'publish_date' => 'required|date',
        ]);

        $information = Information::findOrFail($id);
        $information->update($request->all());

        return redirect()->route('informations.index')->with('success', 'Information updated successfully.');
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('informations.index')->with('success', 'Information deleted successfully.');
    }
}