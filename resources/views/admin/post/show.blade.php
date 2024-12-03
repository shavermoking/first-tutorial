@extends('layouts.main')
@section('content')
    <div>
        <div>{{ $post->id }} . {{ $post->title }}</div>
        <div>{{ $post->content }}</div>
    </div>
    <div>
        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-dark mb-3">Edit</a>
    </div>
    <div>
        <form action="{{ route('admin.post.delete', $post->id) }}" method="post">
            @csrf
            @method('delete')
            <input type="submit" name="Delete" class="btn btn-danger" placeholder="Delete">
        </form>
    </div>
    <div>
        <a href="{{ route('admin.post.index') }}">Back</a>
    </div>
@endsection

