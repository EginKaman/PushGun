<?php

namespace App\Http\Controllers;

use App\Manual;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index()
    {
        return view('manuals.index', [
            'manuals' => Manual::all(),
        ]);
    }

    public function show(Manual $manual)
    {
        return view('manuals.show', [
            'manual' => $manual
        ]);
    }
}
