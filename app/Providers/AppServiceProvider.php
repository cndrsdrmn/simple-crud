<?php

namespace App\Providers;

use App\Contracts\AuthServiceInterface;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Available application services
     *
     * @var string[]
     */
    protected $services = [
        AuthServiceInterface::class => AuthService::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any services
     *
     * @return void
     */
    protected function registerServices()
    {
        foreach ($this->services as $interface => $service) {
            $this->app->singleton($interface, $service);
        }
    }
}
