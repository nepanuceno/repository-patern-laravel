<?php

namespace App\Providers;

use App\Repositories\Repository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\EloquentRepository;

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
        $this->app->bind(Repository::class, function () {
            return new Repository(new EloquentRepository());
        });
    }
}
