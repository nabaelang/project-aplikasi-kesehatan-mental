<!-- resources/views/admin/questions/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="pagetittle">
    <h3>Add Question</h3>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/questions">Questions</a></li>
            <li class="breadcrumb-item active">Add Questions</li>
        </ol>
    </nav>
</div>

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
        <div class="mb-3">
            <label for="question" class="form-label">Question:</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <div class="mb-3">
            <label for="survey_date" class="form-label">Survey Date:</label>
            <input type="date" class="form-control" id="survey_date" name="survey_date" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Answer</label>
            <input type="text" class="form-control" id="answer" name="answer">
        </div>
        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary" >Add Question</button>
    </form>
@endsection
