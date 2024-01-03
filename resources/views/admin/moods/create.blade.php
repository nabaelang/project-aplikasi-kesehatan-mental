<!-- resources/views/admin/moods/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Mood</h2>

        <form action="{{ route('admin.moods.store', ['user_id' => $userIdFromUrl]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="mood" class="form-label">Mood Value</label>
                <input type="text" class="form-control" id="mood" name="mood" required>
            </div>

            <div class="mb-3">
                <label for="survey_date" class="form-label">Survey Date:</label>
                <input type="date" class="form-control" id="survey_date" name="survey_date" required>
            </div>

            <!-- Tambahkan input untuk atribut-atribut lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Create Mood</button>
        </form>
    </div>
@endsection
