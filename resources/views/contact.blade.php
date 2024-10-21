@extends('layouts.main')
@section('content')

<!-- header -->
<header class="flex header-sm">
    <div class="container">
        <div class="header-title">
            <h1>Contact</h1>
            <p>Contact Me For <br> More Detail Information</p>
        </div>
    </div>
</header>
<style>
    .contact-row {
        display: flex;
        flex-direction: row;
        padding: 0 20%;
    }

    .contact-left,
    .contact-right {
        flex: 1;
    }

    @media (max-width: 768px) {
        .contact-row {
            flex-direction: column;
        }

        .contact-left,
        .contact-right {
            flex: none;
        }
    }
</style>
<!-- header -->

<!-- contact section -->
<section id="contact" class="py-4">
    <div class="container">
        <div class="title-wrap">
            <span class="sm-title">information</span>
            <h2 class="lg-title">contact us</h2>
        </div>

        <div class="contact-row">
            <div class="contact-left">
                <form class="contact-form" action="{{ route('sendmessage') }}">
                    <input type="text" name="nama" class="form-control  @error('nama')
                    is-invalid @enderror" placeholder="Your name">
                    @error('nama')
                    <div class="alert alert-danger">Mohon Isikan Nama Anda</div>
                    @enderror

                    <input type="email" name="email" class="form-control @error('email')
                    is-invalid @enderror" placeholder="Your email">
                    @error('email')
                    <div class="alert alert-danger">Mohon Masukan Email Anda</div>
                    @enderror

                    <textarea rows="4" name="pesan" class="form-control @error('pesan')
                    is-invalid @enderror" placeholder="Your message"
                        style="resize: none;"></textarea>
                    @error('pesan')
                    <div class="alert alert-danger">Mohon Isi Pesan Anda</div>
                    @enderror

                    <br/>
                    <input type="submit" class="btn" value="Send message">

                </form>

                <br />
                @if ($message = Session::get('sukses'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

            </div>
            <div class="contact-right my-2">
                <div class="contact-item">
                    <span class="contact-icon flex">
                        <i class="fa fa-phone-alt"></i>
                    </span>
                    <div>
                        <span>Phone</span>
                        <p class="text">{{ $datacontact->phone }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon flex">
                        <i class="fa fa-map-marked-alt"></i>
                    </span>
                    <div>
                        <span>Address</span>
                        <p class="text">{{ $datacontact->address }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <span class="contact-icon flex">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <div>
                        <span>Email</span>
                        <p class="text">{{ $datacontact->email }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
