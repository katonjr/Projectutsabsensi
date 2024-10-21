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
        <h1>Comment Masuk</h1>
    </div>
</div>
<div class="table-container">
    <td colspan="5">
    </td>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">Comment</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $row)
            <tr @if ($row->status == 0 ) class="bold" @endif>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{!! Str::limit($row->pesan, 40) !!}</td>
                <td>

                    <button type="button" class="btn btn-warning klikpesan" data-bs-toggle="modal"
                        data-bs-target="#viewmessage" data-id="{{ $row->id }}">View</button>


                    <form action="{{ route('comment.destroy', $row->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    @if ($showApproveButton || session('comment_status') == App\Models\Comment::PENDING || session('comment_status') == App\Models\Comment::UNREAD)
                        <form action="{{ route('comment.approve', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                    @endif




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
                    <h5 class="modal-title" id="viewmessageLabel">Detail Komen Masuk</h5>
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


<style>
    .bold {
        font-weight: 700;
        font-style: italic;
    }
</style>

<script>
    $(".klikpesan").click(function () {
        let idpesan = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/comment') }}/" + idpesan,
            method: "GET",
            data: {
                key: 'view'
            },
            success: function (data) {
                $("#pesanmasuk").html(data)
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
