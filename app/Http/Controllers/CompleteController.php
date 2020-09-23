<?php

namespace App\Http\Controllers;

use App\Services\ScriptChecker;
use App\Site;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function index(Site $site)
    {
        return view('complete', [
            'site' => $site
        ]);
    }

    public function store(Site $site)
    {
        $site->installed = ScriptChecker::getCheck($site);
        $site->save();
        if ($site->installed) {
            return redirect()->route('site.show', $site);
        }
        return redirect()->route('complete.index', $site);
    }
}
