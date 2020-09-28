<?php


namespace App\Services;


use App\Http\Controllers\SiteController;
use App\Site;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ScriptChecker
{
    public static function getCheck(Site $site)
    {
        $script = $site->script;
        $url = $site->link;
        $check = false;

        $client = new Client();
        $response = $client->request('GET', $url);
        $response = $response->getBody()->getContents();
        $check = Str::contains($response, $script);
        return $check;
    }
}
