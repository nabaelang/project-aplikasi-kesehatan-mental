<!-- resources/views/admin/moods/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit Mood</h2>

    <form action="/admin/moods/{{ $mood->id }}/update" method="POST">
        @csrf
        @method('PUT')

        <label for="mood">Mood:</label>
        <input type="text" id="mood" name="mood" value="{{ $mood->mood }}" required>

        <button type="submit">Update Mood</button>
    </form>
@endsection
