<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function privacy()
    {
        return view('pages.privacy');
    }

    public function blog()
    {
        return view('pages.blog');
    }
    public function test()
    {
        return view('pages.test');
    }

}
