<?php

namespace App\Http\Controllers;

use App\SystemMessage;
use Illuminate\Http\Request;

class SystemMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('notifications.index', [
            'system_messages' => SystemMessage::limit(15)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SystemMessage  $systemMessage
     * @return \Illuminate\Http\Response
     */
    public function show(SystemMessage $systemMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SystemMessage  $systemMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemMessage $systemMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SystemMessage  $systemMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemMessage $systemMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SystemMessage  $systemMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemMessage $systemMessage)
    {
        //
    }
}
