@extends('layouts.main')
@section('content')
            <!-- header -->
            <header class="flex">
                <div class="container">
                    <div class="header-title">
                        <h1>Discover</h1>
                        <p>The World's Hidden Gems<br> Your Journey Starts Here!</p>
                    </div>

                </div>
            </header>
            <!-- header -->

            <!-- featured section -->
            <section id="featured" class="py-2">
                <div class="container">
                    <div class="title-wrap mt-4">
                        <h2 class="sm-title ">information</h2>
                        <h3 class="lg-title">featured places</h3>
                    </div>

                    <div class="featured-row">
                        @foreach ($datafeatured as $featured )
                        <div class="featured-item my-2 shadow">
                            <img src="{{ asset('uploads/'.$featured->image) }}" height="400px" alt="featured place">
                            <div class="featured-item-content">
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $featured->tempat }}
                                </span>
                                   <div>
                                       <p class="text">{{ $featured->deskripsi }}</p>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>


            <!-- end of featured section -->


            <!-- blog section -->
            <section id="blog">

                <div class="wave-image mt-0">
                    <img src="{{ asset('images/ombak.webp') }}" alt="Wave" class="wave-img">
                </div>

                <div class="container">
                    <div class="title-wrap">
                        <h2 class="sm-title">information</h2>
                        <h3 class="lg-title">recent blog</h3>
                    </div>

                    <div class="container">
                        @foreach ($datablog->chunk(6) as $datablogs)
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
                </div>
            </section>


            <br/>
            <br/>
            <br/>

            <!-- end of blog section -->

@endsection
