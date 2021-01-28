@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i posts
                </a>
            </div>
            <dl>
                <dt>Titolo</dt>
                <dd>{{ $post->title }}</dd>
                <dt>Slug</dt>
                <dd>{{ $post->slug }}</dd>
                <dt>Contenuto</dt>
                <dd>{{ $post->content }}</dd>
                <dt>Categoria</dt>
                <dd>{{$post->category ? $post->category->name : '-'}}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
