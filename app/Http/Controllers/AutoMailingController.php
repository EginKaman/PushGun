<?php

namespace App\Http\Controllers;

use App\AutoMailing;
use App\Http\Requests\AutoMailingRequest;
use App\Http\Requests\AutoMailingUpdate;
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
        foreach ($request->pushes as $p) {
            $i++;
            $push = new Push();
            $push->title = $p['title'];
            $push->text = $p['text'];
            $push->link = $p['link'];
            $push->user()->associate(Auth::user());
            $push->time()->associate($p['delay']['time']);
            $push->delay = $p['delay']['value'];
            if ((bool)$p['image']) {
                $push->image = Storage::putFile('public/mails', $p['image']);
            }
            if ((bool)$p['icon']) {
                $push->icon = Storage::putFile('public/mails', $p['icon']);
            }
            $push->save();
            if ((bool)$p['delay']['previousPush']) {
                $push->prev_push_id = $prevPushId;
            } else {
                $prevPushId = $push->id;
            }
            $mailing->status()->associate($request->input('status'));
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
        $mailing->sites()->attach($request->input('sites'));
        $mailing->save();
        return response('created', 200);
    }
    public function update(AutoMailingUpdate $request, AutoMailing $automailing)
    {
        $data = $request->validated();
        if ($request->pushes) {
            $hours = $request->input('hours');
            $minute = $request->input('minute');
            $automailing->time = Carbon::parse("$hours:$minute:00")->isoFormat('HH:mm:ss');
            foreach ($request->input('days') as $day) {
                if ($day === 'monday' || $day === 'tuesday' || $day === 'wednesday' || $day === 'thursday' || $day === 'friday' || $day === 'saturday' || $day === 'sunday') {
                    $automailing[$day] = true;
                }
            }
            foreach ($request->pushes as $item) {
                $push = $automailing->pushes()->where('id', $item['id'])->first();
                if ($push) {
                    $push->link = $item['link'];
                    $push->text = $item['text'];
                    $push->title = $item['title'];
                    $push->delay = $item['delay']['value'];
                    $push->time()->associate($item['delay']['time']);
                    $push->sites()->attach($request->input('sites'));
                    if ((bool)$item['image'] && $push->image !== $item['image']) {
                        $push->image = Storage::putFile('public/mails', $item['image']);
                    }
                    if ((bool)$item['icon'] && $push->icon !== $item['icon']) {
                        $push->icon = Storage::putFile('public/mails', $item['icon']);
                    }
                    $push->save();
                } else {
                    $newPush = new Push();
                    $newPush->user()->associate(Auth::user());
                    $newPush->link = $item['link'];
                    $newPush->text = $item['text'];
                    $newPush->title = $item['title'];
                    $newPush->delay = $item['delay']['value'];
                    $newPush->time()->associate($item['delay']['time']);
                    if ((bool)$item['image']) {
                        $newPush->image = Storage::putFile('public/mails', $item['image']);
                    }
                    if ((bool)$item['icon']) {
                        $newPush->icon = Storage::putFile('public/mails', $item['icon']);
                    }
                    $newPush->save();
                    $automailing->pushes()->attach($newPush->id);
                    $newPush->sites()->attach($request->input('sites'));
                    foreach ($newPush->sites as $site) {
                        $newPush->sent = $site->pushSubscriptions()->count();
                        $newPush->delivered = $site->pushSubscriptions()->count();
                        $newPush->save();
                    }
                    $newPush->save();
                }
            }
            $automailing->sites()->sync([]);
            $automailing->sites()->attach($request->input('sites'));
        }
        $automailing->fill($data);
        $automailing->save();
        return response('updated', 201);
    }
    public function destroy(AutoMailing $automailing)
    {
        $automailing->delete();
        return response('deleted', 204);
    }
}
