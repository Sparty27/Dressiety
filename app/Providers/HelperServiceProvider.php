<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use function Livewire\once;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        foreach(glob(app_path().'/Helpers/services.php') as $filename)
            require_once $filename;
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
