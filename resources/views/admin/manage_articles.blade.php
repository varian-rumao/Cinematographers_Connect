@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Pending Articles</h1>
    <!-- Check if there are any pending articles -->
    @if($articles->isEmpty())
        <p>No pending articles found.</p>
    @else
        <!-- Loop through and display the pending articles -->
        @foreach($articles as $article)
            <div class="article-item">
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->content }}</p> <!-- Use the 'content' field instead of 'description' -->
                <form action="{{ route('admin.approveArticle', $article->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.rejectArticle', $article->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
            <hr> <!-- Optional: Add a horizontal line between articles -->
        @endforeach
    @endif
</div>
@endsection
