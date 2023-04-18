<?php

namespace App\Providers;

use App\Http\Library\ConfigSite;
use Illuminate\Support\ServiceProvider;

class ConfigDefautSiteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('configSite', function () {
            return new ConfigSite();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
