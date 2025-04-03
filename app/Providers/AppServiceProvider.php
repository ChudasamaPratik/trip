<?php

namespace App\Providers;

use App\Models\ContactContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Footer;
use Illuminate\Support\Facades\View;

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
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $footer = Footer::latest()->first();
            $contactUs = ContactContent::latest()->first();

            $view->with([
                'footer' => $footer,
                'contactUs' => $contactUs
            ]);
        });
    }
}
