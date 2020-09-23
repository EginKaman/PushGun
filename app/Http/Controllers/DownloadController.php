<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index(Site $site)
    {
        return response()->download(resource_path('js/pg-push-worker.js'));
    }
}
