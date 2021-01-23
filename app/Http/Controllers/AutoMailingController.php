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

class AutoMailingController extends Controller
{
    public function store(AutoMailingRequest $request)
    {
        $mailing = new AutoMailing;
        foreach ($request->input('days') as $day) {
            if ($day === 'monday' || $day === 'tuesday' || $day === 'wednesday' || $day === 'thursday' || $day === 'friday' || $day === 'saturday' || $day === 'sunday') {
                $mailing[$day] = true;
            }
        }
        $hours = $request->input('hour');
        $minute = $request->input('minute');
        $mailing->time = Carbon::parse("$hours:$minute:00")->isoFormat('HH:mm:ss');
        $mailing->name = $request->input('name');

        $push = new Push();

        $push->title = $request->input('title');
        $push->text = $request->input('text');
        $push->link = $request->input('link');
        $push->site()->associate(1);
        $push->user()->associate(Auth::user());
        if ($request->hasFile('icon')) {
            $push->icon = $request->file('icon')->store('public/mails');
        }
        if ($request->hasFile('image')) {
            $push->image = $request->file('image')->store('public/mails');
        }
        $push->save();
        $push->sites()->attach(explode(',', $request->input('sites')[0]));
        foreach ($push->sites as $site) {
            $push->sent = $site->pushSubscriptions()->count();
            $message = new SendPush();
            $message->title($request->input('title'))
                ->icon(asset(Storage::url($push->icon ?? $site->image)));
            if ($push->image !== null) {
                $message->image(asset(Storage::url($push->image)));
            }
            $message->body($request->input('text'))
                ->url(route('transition.store', $push));
            $site->notify(($message)->delay(now()->addMinutes($request->input('delayNotify'))));
            $push->delivered = $site->pushSubscriptions()->count();
            $push->save();
            $mailing->push_id = $push->id;
            $mailing->save();
            $mailing->pushes()->attach($push->id);
        }
        $mailing->push_id = $push->id;
        $mailing->save();
        return dd($request);
    }
}
