@if ( $data->isNotEmpty())
    {{-- Data Isi Pesan Modal --}}
    @foreach ($data as $item)
        @php
            // Menguraikan JSON hanya jika $item->items tidak kosong dan JSON valid
            $en = json_decode($item->items);
        @endphp

        <div class="">
            Tipe : {{ $item->type }} <br>
            {{-- Untuk mengecek atau melihat kondisi data yang sudah ada atau belum ada --}}
            Kategori : {{ isset($en->nama_category) ? $en->nama_category : 'Tidak ada data' }} <br>
            Time : {{ $item->created_at }} <br>
        </div>
        <hr>
    @endforeach
@else
    <h3>Belum Ada Data Perubahan</h3>
@endif
