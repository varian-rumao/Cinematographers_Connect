@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Total Users: {{ $usersCount }}</p>
    <p>Active Sessions: {{ $activeSessions }}</p>
    <a href="{{ route('admin.manageUsers') }}" class="btn btn-primary">Manage Users</a>
    <a href="{{ route('admin.managePhotos') }}" class="btn btn-primary">Manage Photos</a>
    <a href="{{ route('admin.sessionActivity') }}" class="btn btn-primary">View Session Activity</a>
</div>
@endsection
