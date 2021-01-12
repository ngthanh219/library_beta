<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
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
        $votes = [
            '5' => 5,
            '4' => 4,
            '3' => 3,
            '2' => 2,
            '1' => 1,
        ];

        view()->composer([
            'client.detail_book',
            'client.category',
            'client.category_book',
            'client.home',
            'client.modules.trending'
        ], function ($view) use ($votes) {
            $view->with([
                'categories' => Category::with('children')->where('parent_id', '0')->get(),
                'authors' => Author::take(config('pagination.limit_author'))->get(),
                'newBooks' => Book::with('author')->orderBy('id', 'DESC')->take(6)->get(),
                'likeBooks' => Book::withCount(['likes' => function (Builder $query) {
                    $query->where('status', 0);
                }])->having('likes_count', '<>', 0)->orderBy('likes_count', 'desc')->take(6)->get(),
                'votes' => $votes,
            ]);
        });
    }
}
