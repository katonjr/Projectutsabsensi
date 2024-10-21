@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Add Blog Content</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('recentblog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">

                                <div class="mb-3">
                                    <label for="ImageUpload" class="form-label">Image Upload</label>
                                    <input type="file" name="image" class="form-control @error('image')
                                    is-invalid @enderror" id="image" aria-describedby="Isi Image" >
                                </div>
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Tanggal" class="form-label" >Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal')
                                    is-invalid @enderror" id="tanggal" aria-describedby="Isi Tanggal" value="{{ old('tanggal')}}">
                                </div>
                                @error('tanggal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Kategori" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-control @error('category_id')
                                    is-invalid @enderror" id="kategori" aria-describedby="Pilih Kategori" >
                                        <option value="">Pilih Kategori</option>

                                        @foreach ($data['datakategori'] as $kategori)
                                        <option value="{{ $kategori->id }}"{{old('category_id') == $kategori->id ? 'selected' : ''  }}>{{ $kategori->nama_category }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Judul Blog" class="form-label">Judul Blog</label>
                                    <input type="text" name="judul" class="form-control  @error('judul')
                                    is-invalid @enderror" id="judulblog" aria-describedby="Tulis Judul Blog Anda" value="{{ old('judul')}}">
                                </div>
                                @error('judul')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Deskripsi" class="form-label">Deskripsi Tempat</label>
                                    <textarea name="deskripsi" class="form-control textEditor  @error('deskripsi')
                                    is-invalid @enderror" id="deskripsi"
                                        aria-describedby="Tulis Deskripsi Isi Konten Blog Anda" >{{ old('deskripsi')}}</textarea>
                                </div>
                                @error('deskripsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="Judul Blog" class="mb-2">Tags Blog</label>
                                    <label></label>
                                    <select name="tags_id[]" class="form-select  @error('tags_id[]')
                                    is-invalid @enderror" id="tags_id" data-placeholder="pilih tags" multiple>
                                        <option value="">Pilih Tags</option>
                                        @foreach ($data['datatags'] as $tags)
                                        <option value="{{ $tags->tags }}">{{ $tags->tags }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tags_id[]')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- <div class="mb-3">
                                    <label for="Tags" class="form-label">Tambah Tags</label>
                                    <input type="text" class="form-control @error('tags_id') is-invalid @enderror" name="tags_id">
                                </div>
                                @error('tags_id')
                                <div class="alert alert-danger">{{ $message }}
                            </div>
                            @enderror --}}



                            <div class="mb-3">
                                <label for="Deskripsi" class="form-label">Nama Penulis</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    value="{{ Auth::user()->name }}" readonly>

                                <input type="hidden" name="user_id" class="form-control" id="user_id"
                                    aria-describedby="Tulis Nama Anda" value="{{ Auth::user()->id }}" readonly>
                            </div>

                            @error('user_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#tags_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
            tags: true
        });
    </script>


    <script>
        tinymce.init({
            selector: 'textarea#deskripsi',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
                "See docs to implement AI Assistant")),
        });
    </script>
    @endsection
