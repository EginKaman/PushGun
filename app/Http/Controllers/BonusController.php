<?php

namespace App\Http\Controllers;

use App\BonusHistory;
use App\Http\Requests\BonusHistoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    public function store(BonusHistoryRequest $request) {
        $bonus = new BonusHistory();
        $bonus->fill($request->all());
        $bonus->user()->associate(Auth::user());
        $bonus->save();
        return response('created', 201);
    }

}
