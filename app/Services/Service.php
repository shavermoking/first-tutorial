<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Post;

class Service extends Controller
{
    public function store($data)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);

    }

    public function update($data, Post $post)
    {
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
    }
}
