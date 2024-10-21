@extends('admin.app')

@section('content')

<style>
    .judul {
        text-align: center;
        margin-bottom: 30px;
        /* Menambahkan jarak bawah */
    }
</style>


<div class="judul flex">
    <div>
        <h1>Blog Content</h1>
    </div>
</div>
<div class="table-container">
    <td colspan="5">
        <a href="{{route('recentblog.create')}}" class="btn btn-primary mb-3"> Tambah + </a>
    </td>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Gambar</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kategori</th>
                <th scope="col">Judul</th>
                <th scope="col">Deskripsi Tempat</th>
                <th scope="col">Nama</th>
                <th scope="col">Tags BLog</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ( $data as $row)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td><img src="{{ asset('/uploads/'.$row->image) }}" width="100px" height="100px"></td>
                <td>{{ $row->tanggal }}</td>
                <td>{{ $row->namacategory->nama_category ?? "" }}</td>
                <td>{{ $row->judul }}</td>
                <td>{!! Str::limit ($row->deskripsi,20 )!!}</td>
                <td>{{ $row->nama->name }}</td>
                <td>
                    @php
                    // Counter for limiting the number of tags displayed
                    $tagCount = 0;
                    @endphp
                    @foreach ($row->tags as $tag)
                    @if ($tagCount < 6) <span class="badge badge-danger limited-text">
                        {{ Str::limit($tag->tags, 10) }}</span>
                        @php $tagCount++; @endphp
                        @else
                        @break
                        @endif
                        @endforeach
                </td>

                <td>
                    <a href="{{ route('recentblog.edit', $row->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('recentblog.destroy', $row->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <button type="button" class="btn btn-info klikpesan" style="color: white" data-bs-toggle="modal"
                        data-bs-target="#viewmessage" data-id="{{ $row->id }}">History
                    </button>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>



<!-- Modal -->
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
            url: `{{ url('admin/recentblog/logdatarecentblog/${idpesan}') }}`,
            method: "GET",
            data: {
                nama_table: 'recent_blogs'
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
