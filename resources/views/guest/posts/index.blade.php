@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Tutti i post</h1>
        <ul>
          @foreach ($posts as $post)
            <li>
              {{-- utilizzo lo slug per crare l'url della pagina show di ogni post --}}
              <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                {{ $post->title }}

              </a>
            </li>
          @endforeach

        </ul>
      </div>
    </div>
  </div>

@endsection
