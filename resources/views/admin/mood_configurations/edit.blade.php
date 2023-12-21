<!-- resources/views/admin/mood_configurations/edit.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <h2>Edit Mood Configuration</h2>

    <form action="{{ route('admin.mood-configurations.update', $moodConfiguration) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="question_id" class="form-label">Question</label>
            <select class="form-select" id="question_id" name="question_id">
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}"
                        {{ $question->id == $moodConfiguration->question_id ? 'selected' : '' }}>{{ $question->question }}
                    </option>
                @endforeach
            </select>
