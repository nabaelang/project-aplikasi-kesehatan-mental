<!-- resources/views/admin/questions/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Edit Question</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="question">Question:</label>
            <input type="text" class="form-control" id="question" name="question" value="{{ $question->question }}" required>
        </div>
        <div class="form-group">
            <label for="survey_date">Survey Date:</label>
            <input type="date" class="form-control" id="survey_date" name="survey_date"
                value="{{ $question->survey_date }}" required>
        </div>
        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
@endsection
