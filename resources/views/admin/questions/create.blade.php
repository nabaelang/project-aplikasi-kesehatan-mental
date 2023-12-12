<!-- resources/views/admin/questions/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Add Question</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="form-group">
            <label for="survey_date">Survey Date:</label>
            <input type="date" class="form-control" id="survey_date" name="survey_date" required>
        </div>
        <div class="form-group">
            <label for="answer_options">Answer Options (comma-separated):</label>
            <input type="text" class="form-control" id="answer_options" name="answer_options">
        </div>
        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
@endsection
