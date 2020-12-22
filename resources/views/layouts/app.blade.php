<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>posty</title>
</head>

<body class="bg-gray-200">
  <nav class="py-6 px-16 bg-white flex justify-between mb-6">
    <ul class="flex items-center">
      <li>
        <a href="" class="p-3">Home</a>
      </li>
      <li>
        <a href="" class="p-3">Dashboard</a>
      </li>
      <li>
        <a href="{{ route('posts') }}" class="p-3">Post</a>
      </li>
    </ul>
    <ul class="flex items-center">
      @auth
        <li>
          <a href="" class="p-3">{{ auth()->user()->username }}</a>
        </li>
        <li>
          <a href="" class="p-3">Logout</a>
        </li>
      @endauth
      @guest
        <li>
          <a href="{{ route('login') }}" class="p-3">Login</a>
        </li>
        <li>
          <a href="{{ route('register') }}" class="p-3">Register</a>
        </li>

      @endguest
    </ul>
  </nav>

  @yield('content')
</body>

</html>
