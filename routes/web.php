<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
})->name('index');
Route::post('/subscribe/{site}', 'SubscribeController@update')->name('subscribe.update');
Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id')
    ];
});
Auth::routes();
Route::group(['middlewares' => 'auth'], function () {
    Route::resource('account', 'AccountController')->except([
        'create',
        'store',
        'destroy'
    ]);
    Route::resource('site', 'SiteController');
    Route::resource('push', 'PushController');
    Route::resource('ticket', 'TicketController');
});

