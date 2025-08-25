<?php

namespace App\Providers;

use App\Models\MasterData\DeviceRepair;
use App\Observers\DeviceRepairObserver;
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
        DeviceRepair::observe(DeviceRepairObserver::class);
    }
}
