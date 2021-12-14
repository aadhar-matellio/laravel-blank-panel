<?php

namespace App\Providers;

use App\Observers\UsersObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

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
        // return response without data key wraping.
        JsonResource::withoutWrapping();
        User::observe(UsersObserver::class);
    }
}
