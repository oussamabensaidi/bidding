<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Item;
use App\Policies\ItemPolicy;
class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Item::class => ItemPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * This method is called after all other service providers have been registered.
     * It is used to perform any final bootstrapping of the application.
     */
    public function boot(): void
    {
       
    }
    
}
