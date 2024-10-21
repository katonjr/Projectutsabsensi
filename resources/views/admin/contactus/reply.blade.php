<div class="row justify-content-center">
    <div class="col-8">
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" id="nama" name="nama" value="{{ $data->nama }}" class="form-control @error('nama')
                        is-invalid @enderror" id="nama" aria-describedby="Nama" readonly>
                <br>
                @error('nama')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="email" class="form-label">Email</label>
                <input type="text" id="email" name="email" value="{{ $data->email }}" class="form-control @error('email')
                        is-invalid @enderror" id="email" aria-describedby="Email" readonly>
                <br>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <label for="pesan" class="form-label">Pesan</label>
                <textarea name="pesan"  id="pesan" class="form-control @error('pesan')
                        is-invalid @enderror" id="pesan" aria-describedby="Pesan" required></textarea>
                <br>
                @error('pesan')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
    </div>
</div>
