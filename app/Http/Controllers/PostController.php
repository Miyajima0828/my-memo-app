<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    //class PostController extends Controller

    public function index(Request $request)
    {
        

        return view('index');
    }
}

