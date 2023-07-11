<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //action that searchs a post by title
    public function search(Request $request){
        $posts = \App\Models\Post::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        return view('site.post-list', ['posts' => $posts]);
    }

    //action that returns latest posts
    public function latestPosts(){
        $posts = \App\Models\Post::where('status', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('site.post-list', ['posts' => $posts]);
    }

    //return posts by category
    public function postsByCategory($slug){
        $category = \App\Models\Category::where('slug', $slug)->first();
        if(!$category)
            return redirect()->route('home');
        $posts = $category->posts()->paginate(10);
        return view('site.post-list', ['posts' => $posts]);
    }

    //get post by slug
    public function post($slug){
        $post = \App\Models\Post::where('slug', $slug)->first();
        return view('site.post', ['post' => $post]);
    }
}
