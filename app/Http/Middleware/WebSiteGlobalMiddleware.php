<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WebSiteGlobalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        view()->share('currentRouteName', Route::currentRouteName());
        view()->share('categories', Category::all());
        view()->share('latestPosts', Post::Where('highlighted', false)->OrderBy('created_at', 'desc')->take(4)->get());
        view()->share('highlightedPosts', Post::Where('highlighted', true)->OrderBy('created_at', 'desc')->take(4)->get());

        return $next($request);
    }
}
