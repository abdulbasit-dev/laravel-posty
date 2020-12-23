<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(6); //return a colletion
        return view("posts.index", ["posts" => $posts]);
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'body' => "required|min:5"
        ]);



        //store
        //not a good way, not have relation betwwen post and user
        // Post::create([
        //     'body' => $request->body,
        //     'user_id' => auth()->id(),
        // ]);

        //we went to create a post through a user
        //1
        // $request->user()->post()->create();
        //2
        // auth()->user()->posts()->create([
        //     'body' => $request->body,
        //     //no need for this line laravel automaticly do that
        //     // 'user_id' => auth()->id(),
        // ]);
        auth()->user()->posts()->create($request->only("body"));

        //redirect
        //back() return back to the last page
        return back();
    }
}
