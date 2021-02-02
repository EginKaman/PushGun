<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->has('ref')) {
            session(['refferer' => $request->query('ref')]);
        }
        return view('index', [
            'blogs' => Blog::latest()->limit(4)->get()
        ]);
    }
}
