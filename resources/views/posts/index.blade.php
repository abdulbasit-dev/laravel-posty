@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="bg-white p-6 w-8/12 rounded-lg">

      @auth
        <form action="{{ route('posts') }}" method="POST" class="mb-4">
          @csrf
          <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" cols="30" rows="4" id="body" placeholder="Write your post"
              class="bg-gray-100 w-full border-2 rounded-lg p-4 focus:outline-none focus:ring-1 focus:border-blue-300 @error('body') border-red-500 @enderror">
            {{ old('body') }}</textarea>

            @error('body')
              <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
          </div>

          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Share</button>
        </form>
      @endauth

      @if ($posts->count())
        @foreach ($posts as $post)
          <x-post :post="$post" />
        @endforeach
        {{ $posts->links() }}
      @else
        <p>There is no Post 😢</p>
      @endif
    </div>
  </div>
@endsection
