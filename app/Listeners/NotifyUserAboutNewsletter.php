<?php

namespace App\Listeners;

use App\Mail\ChangeStatusMailingsNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserAboutNewsletter
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::find($event->resource->id);
        if ($event->key !== 'mark-as-confirmed') {
            Mail::to($user->email)->send(new ChangeStatusMailingsNotification('Ваша рассылка отклонена'));
            $event->resource->is_confirmed = 0;
            $event->resource->save();
            return;
        }
        $event->resource->is_confirmed = 1;
        $event->resource->save();
    }
}
