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
            <input type="text" class="form-control" id="question" name="question" value="{{ $question->question }}">
        </div>

        <div class="mb-3">
            <label for="answer_options" class="form-label">Answer</label>
            <input type="text" class="form-control" id="answer_options" name="answer_options"
                value="{{ is_array($question->answer_options) ? implode(', ', $question->answer_options) : $question->answer_options }}">
        </div>
        <div class="mb-3">
            <label for="is_default" class="form-label">Is Default</label>
            <select class="form-select" id="is_default" name="is_default" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        {{-- <div class="mb-3">
            <label for="is_default" class="form-label">Is Default</label>
            <select class="form-select" id="is_default" name="is_default" required>
                <option value="yes" {{ $question->is_default === 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $question->is_default === 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="is_emoticon" class="form-label">Is Emoticon</label>
            <select class="form-select" id="is_emoticon" name="is_emoticon" required>
                <option value="yes" {{ $question->is_emoticon === 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $question->is_emoticon === 'no' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary">Update Question</button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var isDefaultSelect = document.getElementById('is_default');
            var isEmoticonSelect = document.getElementById('is_emoticon');

            isDefaultSelect.addEventListener('change', function() {
                console.log('Is Default:', isDefaultSelect.value);
            });

            isEmoticonSelect.addEventListener('change', function() {
                console.log('Is Emoticon:', isEmoticonSelect.value);
            });
        });
    </script>
@endsection
