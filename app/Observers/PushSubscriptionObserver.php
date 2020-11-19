<?php

namespace App\Observers;

use App\Notifications\NewSubscriber;
use NotificationChannels\WebPush\PushSubscription;

class PushSubscriptionObserver
{
    /**
     * Handle the push subscription "created" event.
     *
     * @param \NotificationChannels\WebPush\PushSubscription $pushSubscription
     * @return void
     */
    public function created(PushSubscription $pushSubscription)
    {
        $pushSubscription->subscribable->user->notify(new NewSubscriber());
    }

    /**
     * Handle the push subscription "updated" event.
     *
     * @param \NotificationChannels\WebPush\PushSubscription $pushSubscription
     * @return void
     */
    public function updated(PushSubscription $pushSubscription)
    {
        //
    }

    /**
     * Handle the push subscription "deleted" event.
     *
     * @param \NotificationChannels\WebPush\PushSubscription $pushSubscription
     * @return void
     */
    public function deleted(PushSubscription $pushSubscription)
    {
        //
    }

    /**
     * Handle the push subscription "restored" event.
     *
     * @param \NotificationChannels\WebPush\PushSubscription $pushSubscription
     * @return void
     */
    public function restored(PushSubscription $pushSubscription)
    {
        //
    }

    /**
     * Handle the push subscription "force deleted" event.
     *
     * @param \NotificationChannels\WebPush\PushSubscription $pushSubscription
     * @return void
     */
    public function forceDeleted(PushSubscription $pushSubscription)
    {
        //
    }
}
