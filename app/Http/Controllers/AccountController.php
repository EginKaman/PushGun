<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NotificationChannels\WebPush\PushSubscription;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $user->loadCount(['pushes']);
//            ->loadCount(['pushes', 'subscriptions', 'todaySubscriptions']);
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions', 'todaySubscriptions');
        return view('account.index', [
            'user' => $user,
            'sites' => $sites,
        ]);
    }

    public function edit()
    {
        return view('account.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        $user->save();
        return redirect()->route('account.index');
    }
}
