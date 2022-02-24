<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', 1)->get();

        foreach ($posts as $post) {
            $post->category = $post->category;
            $post->tags = $post->tags;
        }

        return response()->json($posts);
    }
}
