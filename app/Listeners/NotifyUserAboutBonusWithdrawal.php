<?php

namespace App\Listeners;

use App\Events\NotifiedUserAboutBonusWithdrawal;
use App\Mail\BonusApprovalNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class NotifyUserAboutBonusWithdrawal
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotifiedUserAboutBonusWithdrawal  $event
     * @return void
     */
    public function handle($event)
    {
        $now = Carbon::now();
        $user = User::find($event->resource->id);
        Mail::to($user->email)->send(new BonusApprovalNotification("$user->name $user->lastname", $event->resource->amount, $now));
        $event->resource->status = 1;
        $event->resource->save();
    }
}
