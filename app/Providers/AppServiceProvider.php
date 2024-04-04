<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
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
        config(['app.locale' => 'id']);
	    Carbon::setLocale('id');
        
        // setting level user
        Gate::define('dinas', function (User $user) {
            return $user->role == 1;
        });
        Gate::define('klien', function (User $user) {
            return $user->role == 2;
        });
    }
}
