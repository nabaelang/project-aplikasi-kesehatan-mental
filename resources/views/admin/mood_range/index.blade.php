<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Mood Range List</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
        </ol>
    </div>

    <a href="/admin/mood-range/create" class="btn btn-success mb-3">Add Mood Range</a>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- <a href="{{ route('admin.questions.create') }}" class="btn btn-primary mb-3">Add Question</a> --}}

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Min Percentage</th>
                <th>Max Percentage</th>
                <th>Mood Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($moodRanges as $moodRange)
                <tr>
                    <td>{{ $moodRange->id }}</td>
                    <td>{{ $moodRange->min_range }}</td>
                    <td>{{ $moodRange->max_range }}</td>
                    <td>{{ $moodRange->mood_status }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('admin.mood_range.edit', $moodRange->id) }}" class="btn btn-warning me-2"><i
                                    class="text-white bi bi-pencil-fill"></i></a>
                            <form action="{{ route('admin.mood_range.destroy', $moodRange->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this mood range?')"><i
                                        class="text-white bi bi-trash3-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No Mood Range available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
