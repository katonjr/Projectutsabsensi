@extends('layouts.main')
@section('content')

<!-- header -->
<header class="flex header-sm">
    <div class="container">
        <div class="header-title">
            <h1>Blog Page</h1>
            <p>Read To Get Information <br> Someone About The Journey The Have Taken</p>
        </div>
    </div>
</header>
<!-- header -->

<!-- blog section -->
<section id="blog" class="py-4">

    <div class="wave-image">
        <img src="images/ombak.webp" alt="Wave" class="wave-img">
    </div>

    <div class="container">
        <div class="title-wrap">
            <h2 class="sm-title">information</h2>
            <h3 class="lg-title">recent blog</h3>
        </div>

        <div class="container">
            <div class="row height d-flex justify-content-center align-items-flex">
                <div class="col-md-12 mb-4">
                    <form action="/blog" method="get">
                        <div class="search d-flex align-items-center">
                            <input type="text" class="form-control" name="search" placeholder="Search Blog Article Here"
                                value="{{request()->input('search')}}">
                            <i class="fa fa-search ml-2"></i>
                            <button class="btn btn-primary ml-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($datablog->isNotEmpty())
        <div class="container">
            @foreach ($datablog->chunk(3) as $datablogs)
            <div class="row">
                @foreach ($datablogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-item my-2 shadow">
                        <div class="blog-item-top">
                            <img src="{{ asset('uploads/'.$blog->image) }}" alt="blog" height="300px">
                            <span class="blog-date">{{ date('F, d Y', strtotime($blog->tanggal)) }}</span>
                        </div>
                        <div class="blog-item-bottom">
                            <span>{{ $blog->namacategory->nama_category }} | {{ $blog->nama->name ?? '' }}</span>
                            <a href="{{ url('blog/'. $blog->slug) }}">{{ $blog->judul }}</a>
                            {{-- <p class="text">{!! Str::limit( $blog->deskripsi,20 )!!} </p> --}}
                            <span>{!!Str::limit ($blog->deskripsi,50) !!}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        @else
        <div class="container">
            <div class=" justify-content-center mt-3 mb-4">
                <h1 class="hasilpencarian">------- Maaf Blog Tidak Ditemukan -------</h1>
            </div>
        </div>
        @endif


    </div>

    <style>
        .search {
            display: flex;
            align-items: center;
        }

        .search .form-control {
            flex-grow: 1;
            border: 2px solid #1ec6b6;
            color: #1ec6b6;

        }

        .search .fa-search {
            margin-left: 10px;
        }

        .search .btn {
            margin-left: 10px;
        }

        .hasilpencarian {
            justify-content: center;
            color: #1ec6b6;
            display: flex;

        }
    </style>


</section>
<!-- end of blog section -->

@endsection
