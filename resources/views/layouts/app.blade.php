<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twatter</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-5">
        <ul class="flex items-center">
            <li>
                <a href="/" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{route('dashboard')}}" class="p-3">Dashboard</a>
            </li>
            <li>
                <a href="{{route('posts')}}" class="p-3">Posts</a>
            </li>
        </ul>

        <ul class="flex items-center">

            @auth
            <li>
                <a href="" class="p-3">{{auth()->user()->name}}</a>
            </li>
            <li>
                {{-- For the logout button, we create a POST form with a button instead of just using an anchor link because the <a> is vulnerable to CSRF --}}
                <form action="{{route('logout')}}" method="POST" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                {{-- <a href="{{route('logout')}}" class="p-3">Logout</a> --}}
            </li>
            @endauth

            @guest
            <li>
                <a href="{{route('login')}}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{route('register')}}" class="p-3">Register</a>
            </li>
            @endguest

            {{-- The below code is another way to accomplish the auth / guest differentiation above  --}}

            {{-- @if(auth()->user());
            <li>
                <a href="" class="p-3">Account</a>
            </li>
            <li>
                <a href="" class="p-3">Logout</a>
            </li>
            @else
            <li>
                <a href="" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{route('register')}}" class="p-3">Register</a>
            </li>
            @endif --}}

        </ul>
    </nav>
    @yield('content')
</body>

</html>
