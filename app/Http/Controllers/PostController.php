<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //class PostController extends Controller

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if(!empty($keyword)) {
            $query->where('sub', 'LIKE', "%{$keyword}%")
                ->orWhere('text', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('index', compact('posts', 'keyword'));
    }
}

