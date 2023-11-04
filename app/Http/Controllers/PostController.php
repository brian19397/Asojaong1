<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;

class PostController extends Controller
{

    public function publicaciones()
    {

        $posts = Post::where('estado', 1)->get();
        $imagenes = PostImage::where('estado', 1)->get();

        return view('Post.post', [
            'posts' => $posts,
            'imagenes' => $imagenes
        ]);
    }
}
