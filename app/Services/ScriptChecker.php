<?php


namespace App\Services;

use App\Site;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScriptChecker
{
    /**
     * @param Site $site
     * @return array
     */
    public function getCheck(Site $site): array
    {
        return [
            'script' => $this->checkScript($site->link, $site->script),
            'file' => $this->checkFile($site->link)
        ];
    }

    /**
     * @param $url
     * @param $script
     * @return bool
     */
    protected function checkScript($url, $script): bool
    {
        $response = Http::get($url);
        return Str::contains($response->body(), $script);
    }

    /**
     * @param $url
     * @return bool
     * @throws \Throwable
     */
    protected function checkFile($url): bool
    {
        $response = Http::get("$url/pg-push-worker.js");
        return Str::contains($response->body(), view('scripts.worker')->render());
    }
}
