@extends('layouts.main')
@section('content')

<div class="content-container">
    <div class="rows"
        style="padding-top: 100px;display: flex;flex-wrap: wrap;align-content: stretch;justify-content: space-evenly;align-items: baseline;">
        <!-- Detail Blog -->
        <div class="col-lg-8">
            <div class="blog-title">
                <h1>{{ $blog->judul }}</h1>
            </div>
            <div class="blog-dates mb-3"> {{ $blog->namacategory->nama_category }} | {{ $blog->nama->name ?? '' }} |
                {{ date('F, d Y', strtotime($blog->tanggal)) }}</div>

            <div class="blog-content">

                <img src="{{ asset('uploads/'.$blog->image) }}" alt="Pantai Pacitan" class="">
                <p>
                    {!! $blog->deskripsi !!}
                </p>
            </div>
        </div>


        <div class="tags col-lg-3">
            <h2>Tags Blog:</h2>
            @foreach ($blog->tags as $tag)
            <a href="{{url('blog/'. $blog->slug) }}" class="tag">{{ $tag->tags }}</a> &nbsp
            @endforeach

        </div>
    </div>


    <!-- Recent Blog -->
    {{-- <div class="col-lg-12 recent-blog">
        <br>
        <br>
        <div class="container">
            <div class="title-wrap">
                <h3 class="lg-title">Related Article<br>Maybe You Might Also Like</h3>
            </div>

            <section class="container">
                @foreach ($datablog->chunk(6) as $datablogs)
                <div class="owl-carousel owl-theme">
                    @foreach ($datablogs as $blogItem)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog-item my-2 shadow">
                            <div class="blog-item-top">
                                <img src="{{ asset('uploads/'.$blogItem->image) }}" alt="blog" height="300px">
    <span class="blog-date">{{ date('F d, Y', strtotime($blogItem->tanggal)) }}</span>
</div>
<div class="blog-item-bottom">
    <span>{{ $blogItem->namacategory->nama_category }} | {{ $blogItem->nama->name ?? '' }}</span>
    <a href="{{ url('blog/'. $blogItem->slug) }}">{{ $blogItem->judul }}</a>
    <span>{!!Str::limit ($blogItem->deskripsi,50) !!}</span>
</div>
</div>
</div>
@endforeach
</div>
@endforeach
</section>
</div>
</div> --}}
<div class="col-lg-12 recent-blog">
    <br>
    <br>
    <div class="container">
        <div class="title-wrap">
            <h3 class="lg-title">Related Article<br>Maybe You Might Also Like</h3>
        </div>

        <section class="container">
            <div class="owl-carousel owl-theme">
                @foreach ($datablog as $blogItem)
                <div class="item">
                    <div class="blog-item my-2 shadow">
                        <div class="blog-item-top">
                            <img src="{{ asset('uploads/'.$blogItem->image) }}" alt="blog" height="300px">
                            <span class="blog-date">{{ date('F, d Y', strtotime($blogItem->tanggal)) }}</span>
                        </div>
                        <div class="blog-item-bottom">
                            <span>{{ $blogItem->namacategory->nama_category }} |
                                {{ $blogItem->nama->name ?? '' }}</span>
                            <a href="{{ url('blog/'. $blogItem->slug) }}">{{ $blogItem->judul }}</a>
                            <span>{!! Str::limit($blogItem->deskripsi, 50) !!}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

<br>
<br>
<br>

<div class="col-lg-12 flex">
    <div class="comment-form col-lg-11">
        <h2>Leave a Comment</h2>
        <form class="form kolom" action="{{route('sendcomment')}}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Your Name" required>
            <input type="text" name="blog_id" value="{{ $blog->id }}" hidden>
            <label for="message">Message:</label>
            <textarea id="message" name="pesan" class="form-control" rows="4" required></textarea>

            <button type="submit">Submit</button>

        </form>

        <br>
        <hr>
        <br>
        <h2>Recent Comment</h2>
        <div id="recent-comments">
            @foreach($approvedComments as $comment)
            <div>
                <strong style="color: #1ec6b6">{{ $comment->nama }}</strong>
                <p>{{ $comment->pesan }}</p>
                <br>
            </div>
            @endforeach

        </div>
    </div>
</div>


<style>
    .navbars {
        background-color: #1ec6b6;
    }

    .navbar-cng .navbar-nav .nav-link {
        color: white;
    }

    .navbar-cng .site-brand {
        color: white;
    }

    .navbar-cng .site-brand span {
        color: white;
    }

    .navbar-cng #navbar-show-btn {
        color: white
    }
</style>


<style>
    .blog-title h1 {
        font-size: 35px;
    }

    .blog-content p {
        font-size: 20px;
    }

    .tags h2 {
        font-size: 35px;
    }

    .kolom {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        align-items: flex-start;
    }

    .comment-form {
        background-color: #fff;
        padding: 75px;
        border-radius: 7px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 100px;

    }



    .comment-form h2 {
        margin-top: -20px;
        margin-bottom: 65px;
        font-size: 35px;
        align-items: center;
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
        color: #1ec6b6;
    }

    .comment-form label {
        display: block;
        margin-bottom: 5px;
        color: #1ec6b6;
    }

    .comment-form input,
    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
        color: #1ec6b6;
    }

    .comment-form button {
        display: inline-block;
        background-color: #1ec6b6;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 14px;
    }

    .comment-form button:hover {
        background-color: #1ec6b6;
    }


    .owl-theme .owl-dots .owl-dot {
        display: inline-block;
        zoom: 1.5;
        size: 100px;
    }

    .owl-theme .owl-nav {
        visibility: hidden;
    }
</style>


@endsection
