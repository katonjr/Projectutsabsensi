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
            <h1>Contact</h1>
        </div>
    </div>
    <div class="table-container">
        <td colspan="5">
            {{-- contoh routing pertama --}}
            {{-- <a href="{{ url('category/create') }}" class="btn btn-primary mb-3" > Tambah + </a> --}}

            {{-- contoh routing kedua --}}
            {{-- <a href="{{ route('category.create') }}" class="btn btn-primary mb-3" > Tambah + </a> --}}
        </td>
        <table class="table table-bordered" border="1">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nomer Telpon</th>
                    <th scope="col">Alamat Penulis</th>
                    <th scope="col">Email Penulis</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ( $datas as $row)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->email }}</td>
                    <td>

                        <a href="{{ route('contact.edit', $row->id) }}" class="btn btn-warning">Edit</a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    @endsection
