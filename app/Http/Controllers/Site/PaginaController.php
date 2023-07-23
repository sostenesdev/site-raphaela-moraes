<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagina;

class PaginaController extends Controller
{
    //action that searchs a post by title
    public function search(Request $request){
        $posts = Pagina::where('title', 'like', '%'.$request->search.'%')->paginate(10);
        return view('site_v2.post-list', ['posts' => $posts]);
    }

    //get post by slug
    public function index($slug){
        $post = Pagina::where('slug', $slug)->first();
        return view('site_v2.post', ['model' => $post]);
    }
}
