@extends('layouts.main')
@section('content')
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-success mb-3">Create Post</a>
        </div>

        @foreach($posts as $post)
            <div><a href="{{ route('post.show', $post->id) }}">{{ $post->id }} . {{ $post->title }}</a></div>
             <br>
        @endforeach
@endsection
