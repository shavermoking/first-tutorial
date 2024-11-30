<?php

namespace App\Http\Controllers;


use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::find(1);
        dd($post->likes);
    }
}
