<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ScriptChecker;
use App\Site;
use Illuminate\Http\Request;

class CheckScriptController extends Controller
{
    public function __invoke(Request $request, Site $site)
    {
        $result = (new ScriptChecker())->getCheck($site);
        $site->installed = $result['script'] && $result['file'];
        $site->save();
        return response()->json($result);
    }
}
