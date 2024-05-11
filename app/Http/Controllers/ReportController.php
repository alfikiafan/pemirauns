<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::where('id_user', Auth::id())->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'report' => 'required',
            'report_date' => 'required|date',
            'report_status' => 'required|in:send,pending,solved',
        ]);

        Report::create([
            'id_user' => Auth::id(),
            'report' => $request->report,
            'report_date' => $request->report_date,
            'report_status' => $request->report_status,
        ]);

        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'report' => 'required',
            'report_date' => 'required|date',
            'report_status' => 'required|in:send,pending,solved',
        ]);

        $report = Report::findOrFail($id);
        $report->update($request->all());

        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}