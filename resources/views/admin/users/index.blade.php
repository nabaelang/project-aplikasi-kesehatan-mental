<!-- resources/views/admin/questions/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>User List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telp</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    {{-- <td>
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
                    </td> --}}
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
