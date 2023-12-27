<!-- resources/views/admin/questions/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="pagetittle">
    <h3>Edit Question</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/">Edit Questions</a></li>
    </ol>
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

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="question">Question:</label>
            <input type="text" class="form-control" id="question" name="question" value="{{ $question->question }}" required>
        </div>
        <div class="mb-3">
            <label for="survey_date">Survey Date:</label>
            <input type="date" class="form-control" id="survey_date" name="survey_date"
                value="{{ $question->survey_date }}" required>
        </div>
        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary" >Update Question</button>
    </form>
@endsection
