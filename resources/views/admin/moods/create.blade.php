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
                <label for="avatar_moods" class="form-label">Select Avatar Mood</label>
                @foreach ($avatarMoods as $avatarMood)
                    <label>
                        <input type="radio" name="avatar_moods" id="avatar_moods" value="{{ $avatarMood->image }}"
                            required>
                        <img src="{{ asset('storage/' . $avatarMood->image) }}" alt="{{ $avatarMood->image }}"
                            style="max-width: 100px;">
                    </label>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="survey_date" class="form-label">Survey Date:</label>
                <input type="date" class="form-control" id="survey_date" name="survey_date" required>
            </div>

            <!-- Tambahkan input untuk atribut-atribut lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Create Mood</button>
        </form>

        <!-- jQuery untuk menampilkan gambar terkait dengan radio button yang dipilih -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('input[name="avatar_moods"]').change(function() {
                var selectedImage = $('input[name="avatar_moods"]:checked').siblings('img').attr('src');
                $('#selectedAvatar').attr('src', selectedImage).show();
            });
        </script>
    </div>
@endsection
