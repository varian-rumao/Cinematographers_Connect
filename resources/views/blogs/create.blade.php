@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit an Article</h1>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="5" required></textarea>
        </div>

        <div>
            <label for="keywords">Keywords (optional)</label>
            <input type="text" name="keywords" id="keywords">
        </div>

        <button type="submit">Submit for Review</button>
    </form>
</div>
@endsection
