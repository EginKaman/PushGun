<?php

namespace App\Http\Controllers;

use App\AutoMailing;
use App\Http\Requests\AutoMailingRequest;
use App\Notifications\SendPush;
use App\Push;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AutomailingsResource;

class AutoMailingController extends Controller
{
    
    
    public function store(AutoMailingRequest $request)
    {
        $mailing = new AutoMailing;
        $mailing->user()->associate(Auth::user());
        foreach ($request->input('days') as $day) {
            if ($day === 'monday' || $day === 'tuesday' || $day === 'wednesday' || $day === 'thursday' || $day === 'friday' || $day === 'saturday' || $day === 'sunday') {
                $mailing[$day] = true;
            }
        }
        $hours = $request->input('hours');
        $minute = $request->input('minute');
        $mailing->time = Carbon::parse("$hours:$minute:00")->isoFormat('HH:mm:ss');
        $mailing->name = $request->input('name');
        $i = -1;
        $prevPushId = null;
        foreach($request->pushes as $p) {
            $i++;
            $push = new Push();
            $push->title = $p['title'];
            $push->text = $p['text'];
            $push->link = $p['link'];
            $push->user()->associate(Auth::user());
            $push->time()->associate($p['delay']['time']);
            $push->delay = $p['delay']['value'];
            if((bool)$p['image']) {
                $push->image = Storage::putFile('public/mails', $p['image']);
            }
            if((bool)$p['icon']) {
                $push->icon = Storage::putFile('public/mails', $p['icon']);
            }
            $push->save();
            if((bool)$p['delay']['previousPush']) {
                $push->prev_push_id = $prevPushId;
            } else {
                $prevPushId = $push->id;
            }
            $mailing->status()->associate(1);
            $mailing->save();
            $mailing->pushes()->attach($push->id);
            $push->sites()->attach($request->input('sites'));
            foreach ($push->sites as $site) {
                $push->sent = $site->pushSubscriptions()->count();
                $push->delivered = $site->pushSubscriptions()->count();
                $push->save();
            }
        }
        $mailing->save();
        return;
        return redirect()->route('account.index');
    }
}
