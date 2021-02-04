<?php

namespace App\Http\Controllers;

use App\BonusHistory;
use App\Http\Requests\BonusHistoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    public function store(BonusHistoryRequest $request)
    {
        $user = Auth::user();
        if ($user->bonus_balance < $request->input('amount')) {
            return response('insufficient funds', 403);
        }
        $bonus = new BonusHistory();
        $bonus->fill($request->all());
        $bonus->user()->associate($user);
        $user->bonus_balance = $user->bonus_balance - $request->input('amount');
        $bonus->save();
        $user->save();
        return response('withdrawal request created
        ', 201);
    }
}
