<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\Preference;

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
        if (!App::environment('testing')) {
            $preference = Preference::where('type', 'preference')->first();
            view::share('preference', $preference);

            $contact = Preference::where('type', 'contact')->first();
            view::share('contact', $contact);
        }
    }
}
