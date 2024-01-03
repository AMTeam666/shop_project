<?php

namespace App\Http\Controllers\Customer\Content;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(9);
        return view('customers.content.posts.posts-index', compact('posts'));
    }

    // public function show(Post $post)
    // {
    //     return
    // }
}
