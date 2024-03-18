<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
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
        $categories = Category::all();
        View::share('categories', $categories);

        $latestPost = Post::latest()->take(3)->get();
        View::share('latestPosts', $latestPost);

        $tags = Tag::whereHas('posts')
            ->withCount('posts')
            ->orderBy('posts_count', "DESC")
            ->limit(12)
            ->get();

        View::share('sidebarTags', $tags);

    }
}
