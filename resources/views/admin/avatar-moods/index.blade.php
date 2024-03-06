<!-- resources/views/admin/avatar-moods/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Avatar Moods</h2>

    <a href="/admin/avatar-moods/create" class="btn btn-success mb-3">Add Avatar</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Gender</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($avatarMoods as $avatarMood)
                <tr>
                    <td>{{ $avatarMood->id }}</td>
                    {{-- <td>{{ $avatarMood->gender }}</td> --}}
                    <td>{{ $avatarMood->gender === 'P' ? 'Female' : 'Male' }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $avatarMood->image) }}" alt="Avatar Image" style="max-width: 100px;">
                    </td>
                    <td>
                        {{-- <a href="/admin/avatar-moods/{{ $avatarMood->id }}" class="btn btn-warning me-2">Edit</a> --}}
                        <form action="{{ route('admin.avatar-moods.destroy', $avatarMood->id) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this avatar?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No avatars available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        const editLink = document.querySelector('.edit-link');
        const avatarMoodId = editLink.getAttribute('avatarmoodid');

        editLink.addEventListener('click', function() {
            window.location.href = `/admin/avatar-moods?avatarmoodid=${avatarMoodId}`;
        });
    </script>
@endsection
