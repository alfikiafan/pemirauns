<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('user.contact');
    }
}