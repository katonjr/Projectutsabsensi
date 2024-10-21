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
        <h1>Contact Us Pesan Masuk</h1>
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
                <th scope="col">Email</th>
                <th scope="col">Pesan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $row)
            <tr @if ($row->status == 0 ) class="bold" @endif>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->email }}</td>
                <td>{!! Str::limit($row->pesan, 40) !!}</td>
                <td>

                    <button type="button" class="btn btn-warning klikpesan" data-bs-toggle="modal"
                        data-bs-target="#viewmessage" data-id="{{ $row->id }}">View</button>

                    <button type="button" class="btn btn-info balaspesan" data-bs-toggle="modal"
                        data-bs-target="#replymessage" data-id="{{ $row->id }}">Reply</button>

                    <form action="{{ route('contactus.destroy', $row->id) }}" method="POST" class="d-inline">
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



    <!-- Modal -->
    <div class="modal fade" id="viewmessage" role="dialog" aria-labelledby="viewmessageLabel" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewmessageLabel">Detail Pesan Masuk</h5>
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

{{-- balas pesan masuk --}}
<div class="modal fade" id="replymessage" role="dialog" aria-labelledby="replymessageLabel" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replymessageLabel">Balas Pesan Masuk</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="balaspesan"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary sendmessage">Reply</button>
                <div id="notifikasi"></div>
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
            url: "{{ url('admin/contactus') }}/" + idpesan,
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

    $(".balaspesan").click(function () {
        let idpesan = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/contactus') }}/" + idpesan,
            method: "GET",
            data: {
                key: 'reply'
            },
            success: function (data) {
                $("#balaspesan").html(data)
            }
        });
    });

    $(".sendmessage").click(function () {
        let nama = $("#nama").val();
        let email = $("#email").val();
        let pesan = $("#pesan").val();
        $.ajax({
            url: "{{ url('admin/contactus') }}",
            method: "POST",
            data: {
                'nama': nama,
                'email': email,
                'pesan': pesan,
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log(data)
                // $("#pesanterkirim").html(data);
                window.location.reload();
            },
            error: function (xhr, status, error) {
                if (xhr.status === 422) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.errors.pesan)
                } else {
                    return false;
                }
            }
        });

        $('#viewmessage').on('hidden.bs.modal', function () {
            window.location.reload();
        });
    });
</script>
@endsection
