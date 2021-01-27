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
                  <a class="btn btn-info btn-sm" href="{{ route('admin.posts.show', ['post' => $post->id])}}">
                    Visualizza
                  </a>
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.posts.create')}}">
                    Crea
                  </a>
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{ route('admin.posts.edit', ['post' => $post->id])}}">
                    Modifica
                  </a>
                </td>
                <td>
                  <form class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                        Cancella
                      </button>
                  </form>
                </td>

                {{-- <form class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" name="button">Cancella</button>
                </form> --}}
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
