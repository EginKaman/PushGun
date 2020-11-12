<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

    public function test()
    {
        return view('notification.index');
    }

}
