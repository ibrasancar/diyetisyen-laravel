<?php

namespace App\Providers;

use App\Models\Kullanici;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('tr');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
