<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/subscribe/{site}', [\App\Http\Controllers\SubscribeController::class, 'update'])->name('subscribe.update');
Route::get('/push/{push}/redirect', 'TransitionController')->name('transition.store');
Route::post('payment/check', [\App\Http\Controllers\PaymentController::class, 'check']);
Route::post('payment', [\App\Http\Controllers\PaymentController::class, 'store']);
Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id')
    ];
});
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', 'IndexController')->name('index')->middleware(['guest']);
    Route::get('/privacy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('page.privacy');
    Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{blog}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
    Route::get('/test', [\App\Http\Controllers\PageController::class, 'test'])->name('page.test');
    Route::post('support', [\App\Http\Controllers\MailController::class, 'support'])->name('mail.support');
    Route::post('question', [\App\Http\Controllers\MailController::class, 'question'])->name('mail.question');
    Auth::routes(['verify' => true]);
    Route::middleware(['auth'])->group(function () {
        //TODO: REFACTORING!!!!
        Route::post('/autoMailing', [\App\Http\Controllers\AutoMailingController::class, 'store'])->name('autoMailing.store');
        Route::prefix('account')->group(function () {
            Route::get('/', [\App\Http\Controllers\AccountController::class, 'index'])->name('account.index');
            //TODO: REFACTORING!!!!
            Route::get('autoMailing', [\App\Http\Controllers\AccountController::class, 'automailing'])->name('account.automailing');
            Route::get('saveMailing', [\App\Http\Controllers\AccountController::class, 'savemailing'])->name('account.savemailing');
            Route::get('saveMailingRss', [\App\Http\Controllers\AccountController::class, 'savemailingrss'])->name('account.savemailingrss');
            Route::get('createMailing', [\App\Http\Controllers\AccountController::class, 'createmailing'])->name('account.createmailing');
            Route::get('createMailingRss', [\App\Http\Controllers\AccountController::class, 'createmailingrss'])->name('account.createmailingrss');

            Route::get('edit', [\App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
            Route::put('/', [\App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
        });
        Route::middleware(['verified'])->group(function () {
            Route::get('/payment', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
            Route::get('/notifications', [\App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications.index');
            Route::put('/password', 'PasswordController')->name('account.password');
            Route::resource('site', 'SiteController');
            Route::get('site/{site}/complete', [\App\Http\Controllers\CompleteController::class, 'index'])->name('complete.index');
            Route::post('site/{site}/complete', [\App\Http\Controllers\CompleteController::class, 'store'])->name('complete.store');
            Route::resource('push', 'PushController');
            Route::resource('ticket', 'TicketController')->only(['index', 'show', 'store']);
            Route::post('ticket/{ticket}/message', 'MessageController')->name('message.store');
            Route::get('/tariff', 'TariffController')->name('tariff.index');
        });

        Route::get('manual', [\App\Http\Controllers\ManualController::class, 'index'])->name('manual.index');
        Route::get('manual/{manual}', [\App\Http\Controllers\ManualController::class, 'show'])->name('manual.show');

        Route::get('system_message', [\App\Http\Controllers\SystemMessageController::class, 'index'])->name('system_message.index');
    });
});
Route::group(['prefix' => 'web-api', 'middleware' => 'auth'], function () {
    Route::get('site', 'Api\SiteController');
    Route::post('site/{site}/check', 'Api\CheckScriptController');
    Route::get('site/{site}/statistics', 'Api\SiteStatisticController');
    Route::get('statistics', 'Api\StatisticController');
});

