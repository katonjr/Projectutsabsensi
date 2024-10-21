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
        <h1>Log Content</h1>
    </div>
</div>
<br>

<div class="table-container">

    @if ($logs->count() > 0)
    <!-- Tampilkan tabel log -->
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th scope="col">Nomer</th>
                <th scope="col">Nama Table</th>
                <th scope="col">Aksi</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Editor Admin</th>
                <th scope="col">Perubahan Dibuat</th>

                {{-- <th scope="col">Updated At</th> --}}

            </tr>
        </thead>
        <tbody>
            @php
            $start = ($logs->currentPage() - 1) * $logs->perPage() + 1;
            @endphp
            @foreach ($logs as $log)
            <tr>
                <th scope="row">{{ $start++ }}</th>
                <td>{{ $log->nama_table }}</td>
                <td>{{ $log->type }}</td>
                <td>{{ $log->deskripsi }}</td>
                <td>{{ $log->namauser->name ?? ''}}</td>
                <td>{{ $log->created_at }}</td>
                {{-- <td>{{ $log->updated_at }}</td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tampilkan tombol navigasi halaman -->
    @if ($logs->hasPages())
    <div class="d-flex justify-content-center mt-2 mb-3">
        @if ($logs->previousPageUrl())
        <a href="{{ $logs->previousPageUrl() }}" class="btn btn-outline-primary mr-2">&lsaquo; Halaman Sebelumnya</a>
        @endif

        @if ($logs->nextPageUrl())
        <a href="{{ $logs->nextPageUrl() }}" class="btn btn-outline-primary">Halaman Selanjutnya &rsaquo;</a>
        @endif
    </div>
    @endif
    @endif

</div>


@endsection
