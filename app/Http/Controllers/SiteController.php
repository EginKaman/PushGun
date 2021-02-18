<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteShow;
use App\Http\Requests\SiteStore;
use App\Http\Requests\SiteUpdate;
use App\Http\Resources\SitesResource;
use App\Site;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $sites = $user->sites()->withCount('pushSubscriptions')->get();
        return view('sites.index', [
            'sites' => $sites
        ]);
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
        $site->script = hash('sha256', Str::random(32)) . '.js';
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
     * @param SiteShow $request
     * @param \App\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(SiteShow $request, Site $site)
    {
        return view('sites.show', [
            'site' => $site->loadCount('pushSubscriptions', 'todaySubscriptions', 'pushes'),
            'pushes' => $site->pushes,
            'transitions' => $site->transitions()->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SiteShow $request
     * @param \App\Site $site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(SiteShow $request, Site $site)
    {
        return view('sites.edit', [
            'site' => $site
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Site $site
     * @return \Illuminate\Http\Response
     */
    public function update(SiteUpdate $request, Site $site)
    {
        $site->fill($request->all());
        if ($request->hasFile('image')) {
            Storage::delete($site->image);
            $site->image = $request->file('image')->store('public/sites');
        }
        $site->user()->associate(Auth::user());
        $site->save();
        return redirect()->route('site.show', $site);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Site $site
     */
    public function destroy(SiteShow $request, Site $site)
    {
        Storage::delete($site->script);
        $site->delete();
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
        Storage::drive('local')
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
