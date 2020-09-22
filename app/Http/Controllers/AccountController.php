<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $user->load('sites')->loadMorphCount('sites' , ['pushSubscriptions']);
        return view('account.index', [
            'user' => $user,
            'sites' => $user->sites,
        ]);
    }

    public function edit()
    {
        return view('account.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        $user->save();
        return redirect()->route('account.index');
    }
}
