@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Photos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $photo)
            <tr>
                <td>{{ $photo->id }}</td>
                <td><img src="{{ asset('storage/' . $photo->image_url) }}" width="100" alt="Photo"></td>
                <td>{{ $photo->user->name }}</td>
                <td>
                    <form action="{{ route('admin.deletePhoto', $photo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
