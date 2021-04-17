<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;
use App\Mail\PostLiked;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); //this middleware ensures that only authenticated users can like
    }

    public function store(Post $post, Request $request)
    {
        // dd($post->likes()->withTrashed()->get());
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        } //This if statement should technically never be reached since we handle like duplication by not offering the option via the if state on the index

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()){
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));

        }


        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete(); //we return the user from the request, then the likes from that user, then the likes from that user on this particular post, then we enact a delete on that result

        return back();
    }
}
