@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 lg:w-6/12 bg-white p-6 rounded-lg">

        @auth
        {{-- to ensure that the post composer isn't shown if user is guest. You still have to disallow posting in PostController --}}
        <form action="{{route('posts')}}" method="POST" class="mb-5">
            @csrf

            <div>
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" id="body" cols="30" rows="4"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Compose your Twat..."></textarea>

                @error('body')
                <div class="text-red-500 my-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>

        </form>
        @endauth

        @if ($posts->count())
        @foreach ($posts as $post)
        {{-- Instead of re-writing the markup for displaying the posts, we have made it into a reusable blade component --}}
        <x-post :post="$post" />
        @endforeach

        {{$posts->links()}} {{-- This is all you need to do for Laravel pagination --}}

        @else
        <p>No posts found</p>
        @endif

    </div>
</div>
@endsection
