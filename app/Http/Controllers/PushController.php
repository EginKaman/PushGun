<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushShow;
use App\Http\Requests\PushStore;
use App\Notifications\SendPush;
use App\Push;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $pushes = $user->pushes()->with('site')->withCount('transitions');
        if ($request->filled('start')) {
            $pushes->where('created_at', '>=', Carbon::make($request->start)->startOfDay());
        }
        if ($request->filled('end')) {
            $pushes->where('created_at', '<=', Carbon::make($request->end)->endOfDay());
        }
        if ($request->filled('site')) {
            $pushes->whereSiteId($request->site);
        }
        if ($request->filled('text')) {
            $pushes->where('text', 'like', "%{$request->text}%");
        }
        return view('pushes.index', [
            'pushes' => $pushes->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions');
        return view('pushes.create', [
            'sites' => $sites
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PushStore $request)
    {
        $push = new Push();

        $push->fill($request->all());
        $push->site()->associate($request->site);
        $push->user()->associate(Auth::user());
        if ($request->hasFile('icon')) {
            $push->icon = $request->file('icon')->store('public/mails');
        }
        if ($request->hasFile('image')) {
            $push->image = $request->file('image')->store('public/mails');
        }
        $push->save();
        $site = $push->site;
        $push->sent = $site->pushSubscriptions()->count();
        $message = new SendPush();
        $message->title($request->input('title'))
            ->icon(asset(Storage::url($push->icon ?? $site->image)));
        if ($push->image !== null) {
            $message->image(asset(Storage::url($push->image)));
        }
        $message->body($request->input('text'))
            ->url(route('transition.store', $push));
        $site->notify($message);
        $push->delivered = $site->pushSubscriptions()->count();
        $push->save();

        return redirect()->route('push.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Push $push
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(PushShow $request, Push $push)
    {
        $push->load('site')->loadCount('transitions');
        $site = $push->site->loadCount('pushSubscriptions');
        return view('pushes.show', [
            'push' => $push,
            'site' => $site
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Push $push
     * @return \Illuminate\Http\Response
     */
    public function edit(Push $push)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Push $push
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Push $push)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Push $push
     * @return \Illuminate\Http\Response
     */
    public function destroy(Push $push)
    {
        //
    }
}
