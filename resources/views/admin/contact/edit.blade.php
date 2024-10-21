@extends('admin.app')

@section('content')

<body>
    <div class="judul flex">
        <div class="row justify-content-center">
            <div>
                <h1 class="row justify-content-center mb-4">Edit Contact</h1>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('contact.update',$datas->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="Phone" class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ $datas->phone }}" class="form-control @error('phone')
                                is-invalid @enderror" id="phone" aria-describedby="No Telpon">
                                <br>
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="Address" class="form-label">Address</label>
                                <input type="text" name="address" value="{{ $datas->address }}" class="form-control @error('address')
                                is-invalid @enderror" id="adsress" aria-describedby="Alamat">
                                <br>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <label for="Email" class="form-label">Email</label>
                                <input type="text" name="email" value="{{ $datas->email }}" class="form-control @error('email')
                                is-invalid @enderror" id="email" aria-describedby="Email">
                                <br>
                                @error('email')
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
