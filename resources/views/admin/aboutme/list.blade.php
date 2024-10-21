@extends('admin.app')

@section('content')
    <style>

    .judul {
        text-align: center;
        margin-bottom: 20px;
        /* Menambahkan jarak bawah */
    }
    </style>

    <div class="judul flex">
        <div class="">
            <h1>About Me</h1>
        </div>
        <br>
    </div>
    <div class="table-container">
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Foto Penulis</th>
                    <th scope="col">Nama Penulis</th>
                    <th scope="col">Deskripsi Penulis</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ( $data as $row)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><img src="{{ asset('/uploads/'.$row->image) }}" width="260px" height="350px"></td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>

                        <a href="{{ route('aboutme.edit', $row->id) }}" class="btn btn-warning">Edit</a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endsection
