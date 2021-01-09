<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Author;

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
        view()->composer([
            'client.detail_book',
            'client.category',
            'client.category_book',
            'client.home'
        ], function ($view) {
            $view->with([
                'categories' => Category::with('children')->where('parent_id', '0')->get(),
                'authors' => Author::paginate(config('pagination.limit_author')),
            ]);
        });
    }
}
