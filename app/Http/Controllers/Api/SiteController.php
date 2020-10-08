<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SitesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SitesResource
     */
    public function __invoke(): SitesResource
    {
        $user = Auth::user();
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions');
        return new SitesResource($sites);
    }
}
