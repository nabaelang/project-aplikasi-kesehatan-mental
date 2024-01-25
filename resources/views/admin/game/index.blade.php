<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Game List</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
        </ol>
    </div>

    <a href="/admin/game/create" class="btn btn-success mb-3">Add Game</a>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-3">Add Question</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->title }}</td>
                    <td>{{ $game->description }}</td>
                    <td>{{ $game->link }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $game->image) }}" alt="Game Image" style="max-width: 100px;">
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.game.edit', $game->id) }}" class="btn btn-warning me-2"><i
                                    class="text-white bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.game.destroy', $game->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this question?')"><i
                                        class="text-white bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No game available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
