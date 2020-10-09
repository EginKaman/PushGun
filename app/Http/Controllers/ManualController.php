<?php

namespace App\Http\Controllers;

use App\Category;
use App\Manual;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function index()
    {
        return view('manuals.index', [
            'categories' => Category::with('manuals')->get(),
        ]);
    }

    public function show(Manual $manual)
    {
        return view('manuals.show', [
            'manual' => $manual
        ]);
    }
}
