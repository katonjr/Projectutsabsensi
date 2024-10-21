@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Add Destination Popular Content</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('destiny.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">
                                    <label for="ImageUpload" class="form-label">Image Upload</label>
                                    <input type="file" name="image" class="form-control @error('image')
                                    is-invalid @enderror" id="image" aria-describedby="Isi Image">
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Deskripsi" class="form-label">Deskripsi Singkat Tempat</label>
                                    <textarea name="deskripsi" class="form-control  @error('deskripsi')
                                    is-invalid @enderror" id="deskripsi" aria-describedby="Tulis Deskripsi Isi Konten Blog Anda"></textarea>
                                </div>
                                @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
