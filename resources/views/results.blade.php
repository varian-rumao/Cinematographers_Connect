@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content">
        <div style="padding: 20px; max-width: 800px; margin: 0 auto; font-family: 'Poppins', sans-serif;">
    <h1 style="font-size: 24px; color: #007bff;">Search Results for "{{ $query }}"</h1>

    <div class="results-section" style="margin-top: 20px;">
        <h2 style="font-size: 20px; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px;">Database Results</h2>
        
        <!-- Display Profile Results -->
        @if($profileResults->isNotEmpty())
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($profileResults as $profile)
                <li class="result-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                Profile: <a href="{{ route('works.show', ['id' => $profile->user_id]) }}" style="color: #007bff; text-decoration: none; font-weight: 500;">
                    Searched Keyword: "{{ $query }}"
                </a>
            </li>
                @endforeach
            </ul>
        @else
            <p>No profiles found.</p>
        @endif

        <!-- Display Article Results -->
        @if($articleResults->isNotEmpty())
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($articleResults as $article)
                    <li class="result-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                        Article: <a href="{{ route('articles.show', ['id' => $article->id]) }}" style="color: #007bff; text-decoration: none; font-weight: 500;">{{ $article->title }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No articles found.</p>
        @endif
    </div>

    <!-- Display Static Content Matches -->
    <div class="results-section" style="margin-top: 20px;">
        <h2 style="font-size: 20px; color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px;">Static Content Matches</h2>
        
        <ul style="list-style-type: none; padding: 0;">
            @forelse ($staticResults as $static)
                <li class="result-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #fff;">
                    <a href="{{ $static['link'] }}" style="color: #007bff; text-decoration: none; font-weight: 500;">{{ $static['title'] }}</a>
                </li>
            @empty
                <p>No matches found in static content.</p>
            @endforelse
        </ul>
    </div>

    <!-- Display No Results Message if All Results Are Empty -->
    @if($profileResults->isEmpty() && $workResults->isEmpty() && $articleResults->isEmpty() && empty($staticResults))
        <p style="color: #dc3545; font-weight: bold; margin-top: 20px;">No results found for "{{ $query }}".</p>
    @endif
    </div>

    <div style="margin-top: 20px; text-align: center;">
    <a href="{{ route('home') }}" style="display: inline-block; padding: 10px 20px; font-size: 16px; font-weight: 600; color: #fff; background-color: #007bff; border-radius: 5px; text-decoration: none; transition: background-color 0.3s ease, transform 0.2s ease;">
        Back to Search
    </a>
</div>
</div>
@endsection
