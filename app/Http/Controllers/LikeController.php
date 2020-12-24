<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        //has this user liked before but that like has been deleted
        if (!$post->likes()->onlyTrashed()->where("user_id", $request->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

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
