@extends('layouts.app')

@section('content')
    <div class="pagetittle">
        <h3>Add Article</h3>
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

    <form action="{{ route('admin.article.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <input type="text" class="form-control" id="description" name="description" required>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link:</label>
            <input type="text" class="form-control" id="link" name="link" required>
        </div>

        <button type col-sm-2="submit" class="btn btn-primary">Add Game</button>
    </form>
@endsection
