@extends('layouts.main')
@section('content')
        @foreach($posts as $post)
            <div>{{ $post->title }}</div>
            <div>{{ $post->content }}</div>
            <br>
        @endforeach
@endsection
