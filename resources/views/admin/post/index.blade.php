@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.post.create') }}" class="btn btn-success mb-3">Create Post</a>
    </div>

    @foreach($posts as $post)
        <div><a href="{{ route('admin.post.show', $post->id) }}">{{ $post->id }} . {{ $post->title }}</a></div>
        <br>
    @endforeach

    <div class="mt-3">
        {{ $posts->withQueryString()->links() }}
    </div>
@endsection
