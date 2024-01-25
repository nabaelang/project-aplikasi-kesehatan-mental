@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Edit Game</h3>
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

    <form action="{{ route('admin.game.update', $game->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $game->description }}"
                required>
        </div>
        <div class="mb-3">
            <label for="link">Link:</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ $game->link }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary">Update game</button>
    </form>
@endsection
