@component('mail::message')
  # Your Post was liked

  {{ $liker->name }} liked on of your posts

  @component('mail::button', ['url' => route('posts.show', $post)])
    View post
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
