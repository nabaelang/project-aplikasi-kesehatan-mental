<!-- resources/views/admin/mood-results/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Mood Results</h2>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Mood</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moodResults as $moodResult)
                <tr>
                    <td>{{ $moodResult->user->name }}</td>
                    {{-- <td>{{ implode(', ', $moodResult->user_mood) }}</td> --}}
                    <td>{{ $moodResult->user_mood }}</td>
                    <td>
                        {{-- <form action="{{ route('admin.mood-results.determine-mood', $moodResult->id) }}" method="post">
                            @csrf
                            <button type="submit">Determine Mood</button>
                        </form> --}}
                        <a href="/admin/moods/create/{{ $moodResult->user->id }}">determine mood</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
