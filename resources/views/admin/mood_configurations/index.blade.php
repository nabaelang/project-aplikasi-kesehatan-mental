<!-- resources/views/admin/mood_configurations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Mood Configurations</h2>

    <a href="/admin/mood-configurations/create" class="btn btn-primary">Add Configuration</a>

    @if (session('success'))
        <div class="mt-3 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Question</th>
                <th>Selected Option</th>
                <th>Mood</th>
                <th>Percentage</th>
                {{-- <th>Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($moodConfigurations as $config)
                <tr>
                    <td>{{ $config->question->question }}</td>
                    <td>{{ $config->selected_option }}</td>
                    <td>{{ $config->mood }}</td>
                    <td>{{ $config->percentage }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{-- <a href="/admin/mood-configurations/edit{{ $config }}" class="btn btn-warning me-2"><i
                                    class="text-white bi bi-pencil-fill"></i></a> --}}

                            {{-- <form action="/admin/mood-configurations/destroy{{ $config }}" method="POST" class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="text-white bi bi-trash3-fill"></i></button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
