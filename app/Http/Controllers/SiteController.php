<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteStore;
use App\Http\Resources\SitesResource;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return SitesResource
     */
    public function index(): SitesResource
    {
        $user = Auth::user();
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions');
        return new SitesResource($sites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SiteStore $request): \Illuminate\Http\RedirectResponse
    {
        $site = new Site();
        $site->fill($request->all());
        $site->script = hash('sha256', $site->link) . '.js';
        if ($request->hasFile('image')) {
            $site->image = $request->file('image')->store('public/sites');
        }
        $site->user()->associate(Auth::user());
        $site->save();
        $this->createScript($site);
        return redirect()->route('complete.index', $site);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Site $site)
    {
        return view('sites.show', [
            'site' => $site->loadCount('pushSubscriptions', 'pushes')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site): ?\Illuminate\Http\Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Site $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site): ?\Illuminate\Http\Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Site $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site): ?\Illuminate\Http\Response
    {
        //
    }


    /**
     * @param Site $site
     */
    protected function createScript(Site $site): void
    {
        $script = file_get_contents(resource_path('/js/push.min.js'));
        $script = Str::replaceFirst('APP_URL', config('app.url'), $script);
        $script = Str::replaceFirst('SUBSCRIBE_URL', route('subscribe.update', $site), $script);
        $script = Str::replaceFirst('APP_KEY', config('webpush.vapid.public_key'), $script);
        Storage::disk('local')
            ->put('/public/push/' . $site->script, $script);
    }

    /**
     * @param Site $site
     * @return string
     */
    protected static function getScript(Site $site): string
    {
        return '/storage/push' . $site->script;
    }

}
