<!-- resources/views/admin/avatar-moods/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Create Avatar Mood</h2>

    <form action="/admin/avatar-moods" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
