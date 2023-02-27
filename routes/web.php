<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale,config("app.available_locales"))) {
        abort(400,"Locale not found");
    }
    Cookie::queue(Cookie::make("locale",$locale,43200*6) );

    \Illuminate\Support\Facades\App::setLocale($locale);
    return redirect()->back();
})->name("locale.change");
