<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Information;
use Carbon\Carbon;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::paginate(10);
        View::share('showSearchBox', true);
        return view('admin.information.index', compact('informations'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'required|date|after_or_equal:today',
        ]);
    
        $id_user = Auth::id();
    
        Information::create([
            'user_id' => $id_user,
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
        ]);

        return redirect()->route('admin.information.index')->with('success', 'Information created successfully.');
    }

    public function show(Information $information)
    {
        return view('admin.information.show', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $information->update($request->all());

        return redirect()->route('admin.information.index')->with('success', 'Information updated successfully.');
    }


    public function destroy(Information $information)
    {
        $information->delete();

        return redirect()->route('admin.information.index')->with('success', 'Information deleted successfully.');
    }

    public function guestIndex(Request $request)
    {
        $search = $request->query('search');

        $query = Information::where('publish_date', '<=', Carbon::now())
            ->orderBy('publish_date', 'desc');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $informations = $query->paginate(5);

        $recent_informations = Information::where('publish_date', '<=', Carbon::now())
            ->orderBy('publish_date', 'desc')
            ->take(5)
            ->get();

        return view('guest.info.index', compact('informations', 'recent_informations'));
    }

    public function guestShow(Information $information, Request $request)
    {
        $search = $request->query('search');

        $query = Information::where('publish_date', '<=', Carbon::now())
            ->orderBy('publish_date', 'desc');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $recent_informations = Information::where('publish_date', '<=', Carbon::now())
            ->orderBy('publish_date', 'desc')
            ->take(5)
            ->get();

        return view('guest.info.show', compact('information', 'recent_informations'));
    }

    public function userIndex(Request $request)
    {
        $search = $request->query('search');

        $query = Information::where('publish_date', '<=', Carbon::now())
            ->orderBy('publish_date', 'desc');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $informations = $query->paginate(10);

        return view('user.information.index', compact('informations'));
    }

}