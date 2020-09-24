<?php

namespace App\Http\Controllers;

use App\Tariff;
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

    public function update(Request $request, Tariff $tariff)
    {
        $user = Auth::user();
        $user->tariff()->associate($tariff);
        $user->save();

        return redirect()->route('tariff.index');
    }
}
