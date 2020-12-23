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

      @if (!$posts->count() > 0)
        <p>There is no Post 😢</p>
      @endif

      @foreach ($posts as $post)

        <div class="mb-4 ">
          <a href="" class="font-bold">{{ $post->user->username }}</a> <span
            class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
          <p class="mb-2">{{ $post->body }}</p>

          <div class="flex items-center justify-between">
            @auth
              <div class="flex items-center">

                <div class="mr-4">
                  @if (!$post->isLiked(auth()->user()))
                    <form action="{{ route('posts.likes', $post->id) }}" class="mr-1" method="post">
                      @csrf
                      <button class="text-blue-500 font-medium">Like</button>
                    </form>

                  @else
                    <form action="{{ route('posts.likes', $post->id) }}" class="mr-1" method="post">
                      @csrf
                      @method("DELETE")
                      <button class="text-blue-500 font-medium">Unlike</button>
                    </form>
                  @endif
                </div>
                <span>{{ $post->likes->count() }} {{ Str::plural('Like', $post->likes->count()) }}</span>
              </div>
              @if ($post->ownedBy(auth()->user()))
                <form action="{{ route('posts.destroy', $post) }}" class="mr-1" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="text-red-500 font-medium">Delete</button>
                </form>

              @endif
            @endauth
          </div>
          <div class="bg-gray-100 h-0.5 my-4"></div>
        </div>

      @endforeach
      @php

      @endphp
      {{ $posts->links() }}
    </div>
  </div>
@endsection
