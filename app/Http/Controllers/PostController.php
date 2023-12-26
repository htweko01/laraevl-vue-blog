<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index() {
        $categories = Category::all();
        $posts = Post::where('active', 1)->get();
        return view('user.index', compact(['categories', 'posts']));
    }

    // show a specific post
    public function show($slug) {
        $post = Post::where('slug', $slug)->first();
        return view('user.post', compact('post'));
    }
}
