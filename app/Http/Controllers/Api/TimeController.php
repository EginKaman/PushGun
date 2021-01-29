<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function __invoke()
    {
        return Time::all();
    }
}