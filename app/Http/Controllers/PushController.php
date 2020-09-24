<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pushes = $user->pushes->load('site');
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $push = new Push();

        $push->fill($request->all());
        $push->site()->associate($request->site);
        $push->user()->associate(Auth::user());
        if ($request->boolean('changeIcon')) {
            $push->image = $request->file('image')->store('public/mails');
        }
        $push->save();
        $site = $push->site;
        $site->notify((new SendPush())
            ->title($request->input('title'))
            ->icon(asset(Storage::url($push->image ?? $site->image)))
            ->body($request->input('text'))
            ->url($request->input('link'))
        );

        return redirect()->route('pushes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Push $push
     * @return \Illuminate\Http\Response
     */
    public function show(Push $push)
    {
        $push->load('site');
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
