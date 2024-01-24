@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Edit Article</h3>
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

    <form action="{{ route('admin.article.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description"
                value="{{ $article->description }}" required>
        </div>
        <div class="mb-3">
            <label for="link">Link:</label>
            <input type="text" class="form-control" id="link" name="link" value="{{ $article->link }}" required>
        </div>

        <!-- Tambahkan form input untuk answer_options jika ada -->
        <button type col-sm-2="submit" class="btn btn-primary">Update Article</button>
    </form>
@endsection
