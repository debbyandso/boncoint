<?php

namespace App\Providers;

use Carbon\Carbon;
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
    // function au demarrage(quand je commencez)
    {
        Carbon::setLocale('Fr');
        // pour changer la langue des dates des ads et importe carbon/carbon
    }
}
