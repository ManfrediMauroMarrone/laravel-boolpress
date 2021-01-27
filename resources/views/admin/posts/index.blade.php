@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Titolo</th>
              <th>Slug</th>
              <th>Azioni</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
              <tr>
                <td>{{ $post->id}}</td>
                <td>{{ $post->title}}</td>
                <td>{{ $post->slug}}</td>
                <td>
                  <a class="btn btn-info" href="#">
                    Visualizza
                  </a>
                </td>
                <td>
                  <a class="btn btn-success" href="{{ route('admin.posts.create')}}">
                    Crea Post
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
