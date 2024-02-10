<!-- resources/views/admin/mood_configurations/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Create Mood Configuration</h2>

    <form action="/admin/mood-configurations/store" method="POST">
        @csrf
        {{-- <div class="mb-3">
            <label for="selected_option" class="form-label">Selected Option</label>
            <input type="text" class="form-control" id="selected_option" name="selected_option" required>
        </div> --}}
        <div class="mb-3">
            <label for="question_id" class="form-label">Question</label>
            <select class="form-select" id="question_id" name="question_id">
                @foreach ($questions as $question)
                    <option value="{{ $question->id }}">{{ $question->question }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="selected_option" class="form-label">Answer</label>
            <select class="form-select" id="selected_option" name="selected_option">
                <option value="">No Answer</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="percentage" class="form-label">Percentage</label>
            <input type="number" class="form-control" id="percentage" name="percentage" required>
        </div>
        <div class="mb-3">
            <label for="mood" class="form-label">Mood</label>
            <input type="text" class="form-control" id="mood" name="mood" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
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
