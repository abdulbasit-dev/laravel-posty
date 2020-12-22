@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="bg-white p-6 w-4/12 rounded-lg">
      <h1 class="text-center text-2xl mb-6">Welcome Back, Login To enter your account</h1>
      <form action="{{ route('login') }}" method="POST" autocomplete="on">
        @csrf

        <div class="mb-4">
          <label for="email" class="sr-only">Email</label>
          <input type="email" name="email" id="email" placeholder="Your email"
            class="bg-gray-100 w-full border rounded-lg p-4 focus:outline-none focus:ring focus:border-blue-300 @error('email') border-red-500 @enderror"
            value=" {{ old('email') }}">

          @error('email')
            <small class="text-red-500 text-sm">{{ $message }}</small>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="password" placeholder="Choose a password"
            class="bg-gray-100 w-full border rounded-lg p-4 focus:outline-none focus:ring focus:border-blue-300 @error('password') border-red-500 @enderror">

          @error('password')
            <small class="text-red-500 text-sm">{{ $message }}</small>
          @enderror
        </div>


        <div>
          <button type="submit" class="bg-indigo-500 w-full font-medium px-4 py-3 rounded text-white">Login</button>
        </div>

      </form>
    </div>
  </div>
@endsection
