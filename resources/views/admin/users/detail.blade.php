@extends('layouts.app') // Sesuaikan dengan layout yang digunakan di aplikasi Anda

@section('content')
    <div class="container">
        <h1>User Detail</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <p class="card-text"><strong>ID:</strong>1</p>
                <p class="card-text"><strong>Name:</strong>Reonaldi</p>
                <p class="card-text"><strong>Email:</strong> reo@gmail.com</p>

                <!-- Tambahkan informasi pengguna lainnya sesuai kebutuhan -->

                <a href="" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
