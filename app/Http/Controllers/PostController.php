<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('store', 'destroy'); //enforce user login for the store and destroy methods only
    }

    public function index()
    {
        // $posts = Post::get(); this will return all posts in db which is dangerous, so rather use paginate method as below //returns Laravel collection
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20); //paginate argument is how many display per page
        //with() allows us to eager load the user and likes relationships so that we don't get the n+1 problem with queries. This will load all the neccassary info from those relationships once, instead creating a new query for each iteration
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body')); //you can also create() with an array ['body'=>$request->body]

        return back();
    }

    public function destroy(Post $post)
    {
        //the followinf if block is to prevent someone from deleting someone elses post by changing the id of a delete button in the HTML, but there is a cleaner way to do it via a policy (made through artisan) PostPolicy
        // if(!$post->ownedBy(auth()->user())){
        //     dd('no');
        // }
        $this->authorize('delete', $post); //can we delete (method named defined in policy) this post

        $post->delete();

        return back();
    }
}
