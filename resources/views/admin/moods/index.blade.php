<!-- resources/views/admin/mood_configurations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Moods</h2>

    @if (session('success'))
        <div class="mt-3 alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Mood</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moods as $mood)
                <tr>
                    <td>{{ $mood->user->name }}</td>
                    <td>{{ $mood->mood }}</td>
                    {{-- <a href="/admin/moods/{{ $mood->id }}/edit">Edit Mood {{ $mood->id }}</a> --}}
                    {{-- <td>{{ $mood->mood }}</td> --}}
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="/admin/moods/{{ $mood->id }}/edit" class="btn btn-warning me-2"><i
                                    class="text-white bi bi-pencil-fill"></i></a>

                            {{-- <form action="/admin/mood-configurations/destroy{{ $config }}" method="POST"
                                class="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i
                                        class="text-white bi bi-trash3-fill"></i></button>
                            </form> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
