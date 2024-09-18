@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Photos</h1>
    <div class="row">
        @foreach($photos as $photo)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('storage/' . $photo->file_path) }}" class="card-img-top" alt="Photo">
                <div class="card-body text-center">
                    <form action="{{ route('admin.deletePhoto', $photo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Photo</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
