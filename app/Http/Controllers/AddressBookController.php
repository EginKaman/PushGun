<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressBookController extends Controller
{
    public function index()
    {
        return view('contact.index', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create', []);
    }
}
