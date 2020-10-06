<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushStore;
use App\Notifications\SendPush;
use App\Push;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $pushes = $user->pushes->load('site')->loadCount('transitions');
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions');
        return view('pushes.index', [
            'pushes' => $pushes,
            'sites' => $sites
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
        if ($request->hasFile('image')) {
            $push->image = $request->file('image')->store('public/mails');
        }
        $push->save();
        $site = $push->site;
        $push->sent = $site->pushSubscriptions()->count();
        $site->notify((new SendPush())
            ->title($request->input('title'))
            ->icon(asset(Storage::url($push->image ?? $site->image)))
            ->body($request->input('text'))
            ->url(route('transition.store', $push))
        );
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
    public function show(Push $push)
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
