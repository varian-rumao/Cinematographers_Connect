@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard">
    <h1>Admin Dashboard</h1>
    <div class="stats">
        <p>Total Users: {{ $totalUsers }}</p>
        <p>Total Cinematographers: {{ $totalCinematographers }}</p>
        <!-- Additional statistics and analytics can be added here -->
    </div>
</div>
@endsection
