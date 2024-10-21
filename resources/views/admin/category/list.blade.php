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
        <h1>Category Content</h1>
    </div>
</div>
<div class="table-container">
    <td colspan="5">
        {{-- contoh routing pertama --}}
        <a href="{{ url('admin/category/create') }}" class="btn btn-primary mb-3"> Tambah + </a>

        {{-- contoh routing kedua --}}
        {{-- <a href="{{ route('category.create') }}" class="btn btn-primary mb-3" > Tambah + </a> --}}
    </td>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ( $data as $row)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $row->nama_category }}</td>
                <td>
                    <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning">Edit</a>

                    <button type="button" class="btn btn-info klikpesan" style="color: white" data-bs-toggle="modal"
                        data-bs-target="#viewmessage" data-id="{{ $row->id }}"> History </button>

                    <form action="{{ route('category.destroy', $row->id) }}" method="POST" class="d-inline">
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

<div class="modal fade" id="viewmessage" role="dialog" aria-labelledby="viewmessageLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewmessageLabel">Detail Histori Perubahan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="pesanmasuk"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".klikpesan").click(function () {
        let idpesan = $(this).data('id');
        $.ajax({
            url: `{{ url('admin/category/logdatacategory/${idpesan}') }}`,
            method: "GET",
            data: {
                nama_table: 'categories'
            },
            success: function (response) {
                $("#pesanmasuk").html(response)
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    $(".tutuppesan").click(function () {
        window.location.reload();
    });

    // Handle modal close event to refresh the page
    $('#viewmessage').on('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>








@endsection
