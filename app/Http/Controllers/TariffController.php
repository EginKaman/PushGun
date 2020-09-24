<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TariffController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('tariffs.index', [
            'tariff' => $user->tariff,
            'user' => $user
        ]);
    }

    public function update()
    {

    }
}
