<!-- resources/views/admin/mood_configurations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Mood Configurations</h2>

    <a href="/admin/mood-configurations/create" class="btn btn-primary">Add Configuration</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Question</th>
                <th>Selected Option</th>
                <th>Mood</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moodConfigurations as $config)
                <tr>
                    <td>{{ $config->question->question }}</td>
                    <td>{{ $config->selected_option }}</td>
                    <td>{{ $config->mood }}</td>
                    <td>
                        <a href="/admin/mood-configurations/edit{{ $config }}" class="btn btn-warning">Edit</a>
                        <form action="/admin/mood-configurations/destroy{{ $config }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
