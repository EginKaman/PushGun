<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('blogs.index', [
            'blogs' => Blog::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Blog $blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', [
            'blog' => $blog
        ]);
    }
}
