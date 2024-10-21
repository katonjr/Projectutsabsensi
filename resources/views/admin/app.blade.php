<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Data Presensi Pegawai</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="/amsify/amsify.suggestags.css"> --}}



    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://apalfrey.github.io/select2-bootstrap-5-theme/assets/css/docs.css" />
    <link href="{{asset("admin/css/styles.css ")}}" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://apalfrey.github.io/select2-bootstrap-5-theme/assets/js/docs.js"></script> --}}
    <script src="{{ asset("vendor/tinymce/tinymce.min.js") }}"></script>
    <script src="{{ asset("admin/js/scripts.js") }}"></script>





</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/admin/home">Data Presensi Pegawai </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- kosongan --}}
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        {{-- <a class="nav-link" href="{{ url('admin/featured/featuredplace') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Featured Place
                        </a>
                        <a class="nav-link" href="{{ url('admin/recentblog')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Blog
                        </a>
                        <a class="nav-link" href="{{url('admin/tagsblog')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-tag"></i></div>
                            Tags Blog
                        </a>

                        <a class="nav-link" href="{{ url('admin/category')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                            Category Blog
                        </a>

                        <a class="nav-link" href="{{ url('admin/galerry') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                            Galerry Destination
                        </a>

                        <a class="nav-link" href="{{ url('admin/destiny') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Destination Popular
                        </a>
                        <a class="nav-link" href="{{ url('admin/contact') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-phone"></i></div>
                            Contact
                        </a>


                        <a class="nav-link" href="{{url('admin/contactus')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-address-book"></i></div>
                            Contact US &ensp; &ensp; &nbsp; &nbsp; &nbsp;

                            @php
                                $inbox = \App\Models\ContactUs::where('status',0)->count();
                            @endphp

                            @if ($inbox == 0)
                            @else
                            <span class="badge badge-danger float-right">
                                {{ $inbox }}
                            </span>
                            @endif

                            <span class="sr-only">unread messages</span>
                        </a>

                        <a class="nav-link" href="{{ url('admin/aboutme') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
                            About Me
                        </a> --}}

                        <a class="nav-link" href="{{ url('admin/log') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                            Log
                        </a>

                        {{-- <a class="nav-link" href="{{ url('admin/comment') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-comment"></i></div>
                            Comment &ensp; &ensp; &nbsp; &nbsp; &nbsp; &nbsp;

                            @php
                                $inbox = \App\Models\Comment::where('status',0)->count();
                            @endphp

                            @if ($inbox == 0)
                            @else
                            <span class="badge badge-danger float-right">
                                {{ $inbox }}
                            </span>
                            @endif

                            <span class="sr-only">unread messages</span>

                        </a> --}}

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ auth()->user()->name }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container">
                    <div class="mt-3">
                        @yield('content')
                        @include('sweetalert::alert')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
