<!-- resources/views/admin/mood_configurations/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Edit Mood Configuration</h2>

    <form action="{{ route('admin.mood-configurations.update', $moodConfiguration->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question_id" class="form-label">Question</label>
            <select class="form-select" id="question_id" name="question_id">
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}"
                        {{ $moodConfiguration->question_id == $question->id ? 'selected' : '' }}>
                        {{ $question->question }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="selected_option" class="form-label">Answer</label>
            <select class="form-select" id="selected_option" name="selected_option">
                @foreach ($answerOptions as $option)
                    <option value="{{ $option }}"
                        {{ $moodConfiguration->selected_option == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage</label>
            <input type="number" class="form-control" id="percentage" name="percentage"
                value="{{ $moodConfiguration->percentage }}" required>
        </div>

        <div class="mb-3">
            <label for="mood" class="form-label">Mood</label>
            <input type="text" class="form-control" id="mood" name="mood" value="{{ $moodConfiguration->mood }}"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        document.getElementById('question_id').addEventListener('change', function() {
            var questionId = this.value;
            var answerSelect = document.getElementById('selected_option');
            answerSelect.innerHTML = '';

            // Fetch answer options based on the selected question
            fetch(`/admin/load-answer-options/${questionId}`)
                .then(response => response.text()) // Change to text() instead of json()
                .then(data => {
                    answerSelect.innerHTML = data;
                })
                .catch(error => console.error('Error fetching answer options:', error));
        });
    </script>
@endsection
