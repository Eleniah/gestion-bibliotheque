<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            'Mon super premier titre',
            'Mon super second titre'
        ];

        return view('articles', [
            'posts' => $posts
        ]);
    }

    public function show($id)
    {
        $posts = [
            1 => 'Mon titre n°1',
            2 => 'Mon titre n°2'
        ];

        $post = $posts[$id];

        return view('article', [
            'post' => $post
        ]);
    }
}