<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(["store"]);
    }

    public function index()
    {
        //perform egger loading
        $posts = Post::latest()->with(['user', 'likes'])->paginate(6); //return a colletion
        return view("posts.index", ["posts" => $posts]);
    }

    public function show(Post $post)
    {
        return view('posts.show', ["post" => $post]);
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

    public function destroy(Post $post)
    {
        //authrization
        $this->authorize('delete', $post);

        $post->delete();
        return back();
    }
}
