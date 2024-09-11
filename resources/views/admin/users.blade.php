@extends('layouts.master')

@section('title', 'Manage Users')

@section('content')
<div class="user-management">
    <h2>User Management</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <form method="post" action="{{ route('admin.users.delete', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
