@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="bg-white p-6 w-8/12 rounded-lg">
      <x-post :post="$post" />
    </div>
  </div>
@endsection
