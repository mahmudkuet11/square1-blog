<?php

namespace App\Providers;

use App\Contracts\BlogPlatform;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Services\XBlog;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        Post::observe(PostObserver::class);
    }
}
