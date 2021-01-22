<?php

namespace App\Providers;

use App\Observers\PushSubscriptionObserver;
use App\SystemMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        View::share('system_messages', SystemMessage::limit(5)->latest()->get());
        \NotificationChannels\WebPush\PushSubscription::observe(PushSubscriptionObserver::class);
        date_default_timezone_set('Asia/Almaty');
        Paginator::defaultView('pagination::default');
    }
}
