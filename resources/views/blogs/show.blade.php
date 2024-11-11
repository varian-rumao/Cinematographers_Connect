@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $blog->title }}</h1>
    <p>By {{ $blog->user->name }} on {{ $blog->created_at->format('F j, Y') }}</p>
    <hr>
    <div>
        <p>{{ $blog->content }}</p>
    </div>
    <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Back to Blogs</a>
</div>
@endsection
