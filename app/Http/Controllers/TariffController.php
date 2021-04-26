<?php

namespace App\Http\Controllers;

use App\Http\Resources\TariffEmailResource;
use App\Http\Resources\TariffsEmailResource;
use App\Tariff;
use App\TariffEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TariffController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $user->load('tariffEmail');
        return view('tariffs.index', [
            'tariff' => $user->tariff,
            'user' => $user,
            'tariffs' => Tariff::where('id', '!=', 1)->get(),
            'tariffs_email' => new TariffsEmailResource(TariffEmail::all()),
        ]);
    }
}
