<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = User::first();
        return view('index', [
            'user' => $user
        ]);
    }
}
