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

Route::post('/subscribe/{site}', 'SubscribeController@update')->name('subscribe.update');
Route::get('/push/{push}/redirect', 'TransitionController')->name('transition.store');
Route::post('payment/check', 'PaymentController@check');
Route::post('payment', 'PaymentController@store');
Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id')
    ];
});
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', 'IndexController')->name('index')->middleware(['guest']);
    Route::get('/privacy', 'PageController@privacy')->name('page.privacy');
    Auth::routes();
    Route::middleware(['auth'])->group(function () {
        Route::prefix('account')->group(function () {
            Route::get('/', 'AccountController@index')->name('account.index');
            Route::get('edit', 'AccountController@edit')->name('account.edit');
            Route::put('/', 'AccountController@update')->name('account.update');
        });
        Route::put('/password', 'PasswordController')->name('password.update');
        Route::resource('site', 'SiteController');
        Route::get('site/{site}/complete', 'CompleteController@index')->name('complete.index');
        Route::post('site/{site}/complete', 'CompleteController@store')->name('complete.store');
        Route::resource('push', 'PushController');
        Route::resource('ticket', 'TicketController')->only(['index', 'show', 'store']);
        Route::post('ticket/{ticket}/message', 'MessageController')->name('message.store');
        Route::get('/tariff', 'TariffController')->name('tariff.index');
    });
});
Route::group(['prefix' => 'web-api', 'middleware' => 'auth'], function () {
    Route::get('site', 'Api\SiteController');
    Route::post('site/{site}/check', 'Api\CheckScriptController');
    Route::get('site/{site}/statistics', 'Api\SiteStatisticController');
    Route::get('statistics', 'Api\StatisticController');
});

