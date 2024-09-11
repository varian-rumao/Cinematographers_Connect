@extends('layouts.master')

@section('title', 'Settings')

@section('content')
<div class="settings">
    <h2>Site Settings</h2>
    <form method="post" action="{{ route('admin.settings.update') }}">
        @csrf
        <label for="site_name">Site Name:</label>
        <input type="text" name="site_name" value="{{ $settings->site_name }}" required>
        <label for="site_email">Site Email:</label>
        <input type="email" name="site_email" value="{{ $settings->site_email }}" required>
        <button type="submit">Save Settings</button>
    </form>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
</div>
@endsection
