@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Add Featured Place Content</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('featured.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="ImageUpload" class="form-label  @error('image')
                                is-invalid @enderror">Image Upload</label>
                                <input type="file" name="image" class="form-control" id="image" aria-describedby="Isi Image">
                            </div>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="Nama Tempat" class="form-label">Nama Tempat</label>
                                <input type="text" name="tempat" class="form-control  @error('tempat')
                                is-invalid @enderror" id="tempat" aria-describedby="Isi Nama Tempat">
                            </div>
                            @error('tempat')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Deskripsi Tempat</label>
                                <textarea type="text" name="deskripsi" class="form-control @error('deskripsi')
                                is-invalid @enderror" id="Deskripsi" aria-describedby="Tulis Deskripsi Tempat Anda"></textarea>
                            </div>
                            @error('deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
