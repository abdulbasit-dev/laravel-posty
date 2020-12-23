<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        //like a post through a post
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        //recirect
        return back();
    }

    public function destroy(Post $post, Request $request)
    {

        //this way delete all the like on that post regarless of how many user is liked
        // for example if two user like a post by this way all two like wil be deleted
        // $post->likes()->where("post_id", $post->id)->delete();

        //delete the like by current user
        $request->user()->likes()->where("post_id", $post->id)->delete();

        //redirect
        return back();
    }
}
