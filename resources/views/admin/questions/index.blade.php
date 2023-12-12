<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Question List</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-3">Add Question</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Survey Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->survey_date }}</td>
                    <td>
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No questions available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
