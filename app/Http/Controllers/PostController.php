<?php

namespace App\Http\Controllers;


use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        dd($posts);
    }

    public function create()
    {
        $postArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'some interesting content',
                'image' => 'image.jpg',
                'likes' => 20,
                'is_published' => true,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'another some interesting content',
                'image' => 'poimage.jpg',
                'likes' => 30,
                'is_published' => true,
            ]
        ];

        foreach ($postArr as $item) {
            Post::create($item);
        }

    }

    public function delete()
    {
        $post = Post::find(1);
        $post->delete();
    }
}
