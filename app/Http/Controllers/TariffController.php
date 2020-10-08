<?php

namespace App\Http\Controllers;

use App\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TariffController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        return view('tariffs.index', [
            'tariff' => $user->tariff,
            'user' => $user,
            'tariffs' => Tariff::where('id', '!=', 1)->get()
        ]);
    }
}
