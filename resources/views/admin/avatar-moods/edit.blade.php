<!-- resources/views/admin/avatar-moods/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit Avatar Mood</h2>

    <form action="{{ route('admin.avatar-moods.update', $avatarMood->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="male" {{ $avatarMood->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $avatarMood->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
