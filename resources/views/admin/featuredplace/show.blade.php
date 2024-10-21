{{-- Komen Dari : {{ $data->nama }} --}}
@foreach ($data as $item)
    @php
        $en = json_decode($item->items);
    @endphp

<div class="">
    Tipe : {{ $item->type }} <br>
    Gambar : <br>
    <img src="{{ asset('uploads/'.$en->image) }}" alt="" width="20%">
    <br>
    Tempat : {{ $en->tempat }} <br>
    Deskripsi : {{ $en->deskripsi }} <br>
    Time : {{ $item->created_at }} <br>
    Nama Editor : {{ auth()->user()->name }}
</div>
<hr>
@endforeach
<br>
<br>
{{-- {{ $data->pesan }} --}}

