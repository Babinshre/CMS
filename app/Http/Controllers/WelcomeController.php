<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $search = request()->query('search'); 
        if($search)
        {
            $post = Post::where('title','LIKE',"%{$search}%")->paginate(1);
        }
        else
        {
            $post = Post::paginate(3);
        }
        return view('welcome')
            ->with('categories',Category::all())
            ->with('tags',Tag::all())
            ->with('posts',$post);
    }
}
