<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Observers\BlogPostObserver;
use App\Observers\BlogCategoryObserver;

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
         Paginator::useBootstrap();
         BlogPost::observe(BlogPostObserver::class);
         BlogCategory::observe(BlogCategoryObserver::class);

    }
}
