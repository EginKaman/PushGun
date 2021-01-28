<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use App\Http\Resources\AutomailingsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutoMailingController extends Controller
{
    public function __invoke()
    {
        $user =  Auth::user();
        $automailings = $user->automailings()->get();
        return $automailings;
    }
}