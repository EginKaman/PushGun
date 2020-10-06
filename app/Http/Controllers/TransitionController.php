<?php

namespace App\Http\Controllers;

use App\Push;
use App\Transition;
use Illuminate\Http\Request;

class TransitionController extends Controller
{
    public function store(Request $request, Push $push)
    {
        $transition = new Transition([
            'ip' => $request->getClientIp(),
            'user_agent' => $request->userAgent()
        ]);
        $transition->push()->associate($push);
        $transition->save();
        return redirect($push->link ?? $push->site->link);
    }
}
