@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Edit Featured Place Content</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action= "{{  url('admin/featured/updatedatafeatured/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Image Upload</label>
                                <input type="file" name="image" class="form-control" id="image" aria-describedby="Isi Image">
                                <br>
                                <img src="{{ asset('uploads/'.$data->image) }}" width="100px" width="100px">
                                {{-- <label class="form-control">{{$data->image}}</label> --}}
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Tempat</label>
                                <input type="text" name="tempat" class="form-control" id="tempat"
                                    aria-describedby="Isi Nama Tempat" value="{{ $data->tempat }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Deskripsi Tempat</label>
                                <textarea type="text" name="deskripsi" class="form-control" id="Deskripsi"
                                    aria-describedby="Tulis Deskripsi Tempat Anda" >{{ $data->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
