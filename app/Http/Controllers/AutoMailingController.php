<?php

namespace App\Http\Controllers;

use App\AutoMailing;
use App\Http\Requests\AutoMailingRequest;
use App\Notifications\SendPush;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutoMailingController extends Controller
{
    public function store(AutoMailingRequest $request)
    {
        $mailing = new AutoMailing;
        foreach ($request->input('days') as $day) {
            if ($day === 'monday' || $day === 'tuesday' || $day === 'wednesday' || $day === 'thursday' || $day === 'fridat' || $day === 'saturday' || $day === 'sunday') {
                $mailing[$day] = true;
            }
        }
        $hours = $request->input('hour');
        $minute = $request->input('minute');
        $mailing->push_id = 3;
        $mailing->time = Carbon::parse("$hours:$minute:00")->isoFormat('HH:mm:ss');
        $mailing->name = $request->input('name');
        $mailing->save();
        return dd($request);
    }
}
