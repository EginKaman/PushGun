<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('index', [
            'blogs' => Blog::latest()->limit(4)->get()
        ]);
    }
}
