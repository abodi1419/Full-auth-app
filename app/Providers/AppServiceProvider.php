<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('path.public', function() {
            return realpath(base_path().'/../html');
        });
        if (Cookie::has("locale")&&in_array(Cookie::get("locale"),config("app.available_locales"))){
            App::setLocale(Cookie::get('locale'));
        }else{
            App::setLocale(config("app.fallback_locale"));
        }


        URL::forceScheme("https");

    }
}
