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
    <div>
        <h1>Galerry Content</h1>
    </div>
</div>
<div class="table-container">
    <td colspan="5">
        <a href="{{route('galerry.create')}}" class="btn btn-primary mb-3"> Tambah + </a>
    </td>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ( $data as $row)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="{{ asset('/uploads/'.$row->image) }}" width="150px" height="150px"></td>
                <td>
                    <a href="{{ route('galerry.edit', $row->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('galerry.destroy', $row->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
