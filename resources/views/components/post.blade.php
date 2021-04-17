{{-- This is a blade component made with "php artisan make:component". Remember to delete the corresponding class created in app>view>components --}}

@props(['post'=>$post])

<div class="mb-4">
    <a href="{{route('users.posts', $post->user)}}" class="font-bold">{{$post->user->username}} </a><span
        class="text-gray-600 text-sm">{{$post->created_at->diffForHumans()}}</span>
    {{-- Laravel minipulates dates via Carbon --}}
    <p class="mb-2">{{$post->body}}</p>

    {{-- @if ($post->ownedBy(auth()->user())) --}}
    {{-- This will ensure that a user can only delete it's own post if we were using the ownedBy method, we are instead using policy --}}
    @can('delete', $post) {{-- this uses the policy auth, can we delete this post --}}
    <form action="{{route('posts.destroy', $post)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500">Delete</button>
    </form>
    @endcan

    {{-- @endif --}}

    <div class="flex items-center">
        @auth {{-- We only run the following if block if user is logged in--}}
        @if (!$post->likedBy(auth()->user()))
        <form action="{{route('post.likes', $post->id)}}" method="POST" class="mr-1">
            @csrf
            <button type="submit" class="text-blue-500">Like</button>
        </form>
        @else
        <form action="{{route('post.likes', $post->id)}}" method="POST" class="mr-1">
            @csrf
            @method('DELETE') {{-- This is how you method spoof --}}
            <button type="submit" class="text-blue-500">Unlike</button>
        </form>
        @endif
        @endauth

        @if ($post->likes->count())
        <span>{{$post->likes->count()}}
            {{Str::plural('like', $post->likes->count())}}</span>{{-- the Str class helps do cool things with strings. In this case we are using the 'plural' method so that laravel auto decides between displaying 'like' or 'likes' --}}
        @endif
    </div>
</div>
