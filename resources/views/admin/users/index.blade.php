@extends('layouts.app') // Sesuaikan dengan layout yang digunakan di aplikasi Anda

@section('content')
    <div class="container">
        <h1>User List</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>reonaldi</td>
                    <td>reo@gmail.com</td>
                    <td>
                        <a href="" class="btn btn-primary">Edit</a>
                        <a href="users/detail" class="btn btn-primary">Detail</a>
                        <a href="" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
