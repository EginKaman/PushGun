<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\AutoMailingStatuses;
use Illuminate\Http\Request;

class AutoMailingStatusController extends Controller
{
    public function __invoke()
    {
        return AutoMailingStatuses::all();
    }
}