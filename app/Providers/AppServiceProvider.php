<?php

namespace App\Providers;

use App\Models\Admin\Category;
use Illuminate\Support\ServiceProvider;
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
    public function boot()
    {
        View::composer('*', function ($view) {
            $categories = Category::with(['subCategories.childCategories'])
                ->where('status', 1)
                ->get();

            $view->with('categories', $categories);
        });
    }
}
