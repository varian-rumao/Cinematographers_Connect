@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Session Activity</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Session ID</th>
                <th>User ID</th>
                <th>IP Address</th>
                <th>Last Activity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
            <tr>
                <td>{{ $session->id }}</td>
                <td>{{ $session->user_id }}</td>
                <td>{{ $session->ip_address }}</td>
                <td>{{ \Carbon\Carbon::parse($session->last_activity)->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
