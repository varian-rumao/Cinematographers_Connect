@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Search Results for "{{ $query }}"</h1>

    @if (!empty($results))
        <ul class="list-group mt-3">
            @foreach ($results as $result)
                <li class="list-group-item">{{ $result }}</li>
            @endforeach
        </ul>
    @else
        <p>No results found.</p>
    @endif
</div>
@endsection
