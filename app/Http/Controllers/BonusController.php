<?php

namespace App\Http\Controllers;

use App\BonusHistory;
use App\Http\Requests\BonusHistoryRequest;
use App\Mail\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BonusController extends Controller
{
    public function store(BonusHistoryRequest $request)
    {
        $user = Auth::user();
        if ($user->bonus_balance < $request->input('amount')) {
            return response()->json([
                'message' => __('Недостаточно средств'),
                'type' => 'error'
            ]);
        }
        $bonus = new BonusHistory();
        $bonus->fill($request->all());
        $bonus->user()->associate($user);
        $user->bonus_balance = $user->bonus_balance - $request->input('amount');
        $bonus->save();
        $user->save();
        Mail::to(config('mail.from.address'))->send(new Bonus("$user->lastname $user->name", $request->input('amount')));
        return response()->json([
            'message' => __('Запрос на снятие бонуса обрабатывается'),
            'type' => 'success'
        ]);
    }
}
