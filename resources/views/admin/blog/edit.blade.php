@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Edit Blog Content</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{  url('admin/recentblog/'.$data->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Image Upload</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    aria-describedby="Isi Image">
                                <br>
                                <img src="{{ asset('uploads/'.$data->image) }}" width="100px" width="100px">
                                {{-- <label class="form-control">{{$data->image}}</label> --}}
                            </div>

                            <div class="mb-3">
                                <label for="Tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal')
                                is-invalid @enderror" id="tanggal" aria-describedby="Isi Tanggal"
                                    value="{{ $data->tanggal }}">
                            </div>
                            @error('tanggal')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="Kategori" class="form-label">Kategori</label>

                                <select name="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" id="kategori"
                                    aria-describedby="Pilih Kategori">
                                    @foreach($datakategori as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ $kategori->id == $data->category_id ? 'selected' : '' }}>
                                        {{ $kategori->nama_category }}
                                    </option>
                                    @endforeach
                                </select>



                            </div>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="Judul Blog" class="form-label">Judul Blog</label>
                                <input type="text" name="judul" class="form-control  @error('judul')
                                is-invalid @enderror" id="judulblog" aria-describedby="Tulis Judul Blog Anda"
                                    value="{{ $data->judul }}">
                            </div>
                            @error('judul')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Deskripsi Tempat</label>
                                <textarea name="deskripsi" class="form-control  @error('deskripsi')
                                is-invalid @enderror" id="deskripsi"
                                    aria-describedby="Tulis Deskripsi Isi Konten Blog Anda">{{ $data->deskripsi }}</textarea>
                            </div>
                            @error('deskripsi')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="mb-3">
                                <label for="Judul Blog">Tags Blog</label>
                                <br>
                                <select class="form-select" id="tags_id" data-placeholder="pilih tags" multiple
                                    name="tags_id[]">
                                    <option value="">Pilih Tags</option>
                                    @foreach ($datatag as $value )

                                    <option value="{{ $value->tags }}" @if (in_array($value->tags , $data->getTagsId()))
                                        selected @endif>{{ $value->tags }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Nama Penulis</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    value="{{ $data->nama->name }}" readonly>

                                <input type="hidden" name="user_id" class="form-control" id="user_id"
                                    aria-describedby="Tulis Nama Anda" value="{{ $data->user_id }}" readonly>
                            </div>

                            @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror



                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                $('#tags_id').select2({
                    theme: "bootstrap-5",
                    width: '100%',
                    placeholder: 'Pilih Tags',
                    closeOnSelect: true,
                    tags: true
                });
            });
        </script>


        <script>
            tinymce.init({
                selector: 'textarea#deskripsi',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>

@endsection
