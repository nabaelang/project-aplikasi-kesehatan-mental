<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="pagetittle">
    <h3>Question List</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/admin/questions">List Questions</a></li>
    </ol>
</div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-3">Add Question</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Survey Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($questions as $question)
                <tr>
                    <td>{{ $question->id }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->answer }}</td>
                    <td>{{ $question->survey_date }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                        <a href="{{ route('admin.questions.edit', $question->id) }}" class="btn btn-warning me-2"><i 
                            class="text-white bi bi-pencil-fill"></i></a>
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this question?')"><i
                                class="text-white bi bi-trash3-fill"></i></button>
                        </form>
                    </div>
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
