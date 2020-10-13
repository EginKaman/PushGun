<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteShow;
use App\Services\ScriptChecker;
use App\Site;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function index(SiteShow $request, Site $site)
    {
        return view('complete', [
            'site' => $site
        ]);
    }

    public function store(SiteShow $request, Site $site)
    {
        $check = (new ScriptChecker())->getCheck($site);
        $site->installed = $check['script'] && $check['file'];
        $site->save();
        if ($site->installed) {
            return redirect()->route('site.show', $site);
        }
        return redirect()->route('complete.index', $site);
    }
}
