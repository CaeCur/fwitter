@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 lg:w-6/12">

        <div class="p-6">
            <h1>{{$user->name}}</h1>
            <p>Posted {{$posts->count()}} {{Str::plural('post', $posts->count())}}
                @if($user->recievedLikes->count())
                <span>| Recieved {{$user->recievedLikes->count()}} likes</span>
                @endif
            </p>
        </div>

        <div class="bg-white p-6 rounded-lg">
            @if ($posts->count())
            @foreach ($posts as $post)
            {{-- Instead of re-writing the markup for displaying the posts, we have made it into a reusable blade component --}}
            <x-post :post="$post" />
            @endforeach

            {{$posts->links()}} {{-- This is all you need to do for Laravel pagination --}}

            @else
            <p>{{$user->name}} has not posted anything.</p>
            @endif
        </div>
    </div>
</div>
@endsection
