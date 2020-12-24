@props(['post'=>$post])

<div class="mb-4 ">
  <a href="{{ route('users.posts', $post->user) }}"
    class="font-bold hover:text-indigo-500 transform scale-150 mr-3">{{ $post->user->username }}</a> <span
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

      @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" class="mr-1" method="post">
          @csrf
          @method('DELETE')
          <button class="text-red-500 font-medium">Delete</button>
        </form>
      @endcan

    @endauth
  </div>
  <div class="bg-gray-100 h-0.5 my-4"></div>
</div>
