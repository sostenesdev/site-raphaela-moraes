<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //action that searchs a post by title
    public function search(Request $request){
        $posts = Post::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        return view('site_v2.post-list', ['posts' => $posts]);
    }

    //action that returns latest posts
    public function latestPosts($tipo = null){
        $posts = \App\Models\Post::where('tipo_pagina', $tipo)->orderBy('created_at', 'desc')->paginate(10);
        return view('site_v2.post-list', ['model' => $posts]);
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
        return view('site_v2.post', ['model' => $post]);
    }
}
