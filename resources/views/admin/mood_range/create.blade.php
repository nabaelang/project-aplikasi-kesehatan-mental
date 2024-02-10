@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Add Mood Status</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
            </ol>
        </nav>
    </div>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form action="{{ route('admin.mood_range.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="min_range" class="form-label">Min Percentage:</label>
            <input type="text" class="form-control" id="min_range" name="min_range" required>
        </div>
        <div class="mb-3">
            <label for="max_range" class="form-label">Max Percentage:</label>
            <input type="text" class="form-control" id="max_range" name="max_range" required>
        </div>
        <div class="mb-3">
            <label for="mood_status" class="form-label">Mood Status:</label>
            <input type="text" class="form-control" id="mood_status" name="mood_status" required>
        </div>

        <button type col-sm-2="submit" class="btn btn-primary">Add Mood Status</button>
    </form>
@endsection
