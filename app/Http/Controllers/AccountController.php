<?php

namespace App\Http\Controllers;

use App\BonusPercent;
use App\Http\Requests\AccountUpdate;
use App\Payment;
use App\Services\SmsExpectoService;
use App\Site;
use App\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;
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
        $sites = $user->sites;
        // $sites->loadCount('pushSubscriptions', 'todaySubscriptions', 'transitions', 'todayTransitions');
        $sites->loadCount('pushSubscriptions', 'todaySubscriptions');
        return view('account.index', [
            'user' => $user,
            'sites' => $sites,
            'pushes' => $user->pushes,
        ]);
    }

    public function edit()
    {
        return view('account.edit', [
            'user' => Auth::user()
        ]);
    }

    public function automailing()
    {
        return view('account.automailing');
    }
    public function automailingEdit($id)
    {
        $user = Auth::user();
        $automailing = $user->automailings()->where('id', $id)->with(['pushes', 'sites'])->first();
        return view('account.automailingEdit', [
            'automailing' => $automailing
        ]);
    }

    public function saveMailing()
    {
        $user = Auth::user();
        $sites = $user->sites;
        $sites->loadCount('pushSubscriptions');
        return view('account.savemailing', [
            'sites' => $sites
        ]);
    }
    public function saveMailingRss()
    {
        return view('account.savemailingrss');
    }
    public function createMailing()
    {
        return view('account.createmailing');
    }

    public function referal()
    {
        $user = Auth::user();
        $referral_link = $user->getReferralLinkAttribute();
        $referral_count = $user->referrals()->count();
        $payments_made = Payment::all()->load('user')->where('referrer_id', $user->id)->count();
        return view('account.referal', [
            'refferal_link' => $referral_link,
            'referral_count' => $referral_count,
            'bonus_balance' => $user->bonus_balance,
            'payments_made' => $payments_made,
        ]);
    }

    public function createMailingRss()
    {
        return view('account.createmailingrss');
    }



    public function update(AccountUpdate $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        if ($request->hasFile('photo')) {
            $user->photo = $request->photo->store('public/photos');
        }
        $user->save();
        return redirect()->route('account.index');
    }
}
