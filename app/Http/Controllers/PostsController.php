<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function all() {
        $items = Post::all();
        return view('posts.all', ['items' => $items]);
    }
}
