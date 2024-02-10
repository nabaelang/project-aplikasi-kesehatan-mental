@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Edit Mood Range</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
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

    <form action="{{ route('admin.mood_range.update', $moodRange->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="min_range">Min Percentage:</label>
            <input type="text" class="form-control" id="min_range" name="min_range" value="{{ $moodRange->min_range }}">
        </div>
        <div class="mb-3">
            <label for="max_range">Max Range:</label>
            <input type="text" class="form-control" id="max_range" name="max_range" value="{{ $moodRange->max_range }}">
        </div>
        <div class="mb-3">
            <label for="mood_status">Mood Status:</label>
            <input type="text" class="form-control" id="mood_status" name="mood_status"
                value="{{ $moodRange->mood_status }}" required>
        </div>

        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary">Update Mood Status</button>
    </form>
@endsection
