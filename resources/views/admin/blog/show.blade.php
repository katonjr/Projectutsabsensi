@if ($data->isNotEmpty())
  {{-- Data Isi Pesan Modal --}}
@foreach ($data as $item)

@php
    $en = json_decode($item->items);
@endphp

<div class="">
Tipe : {{ $item->type }} <br>
Gambar : <br>
<img src="{{ asset('uploads/'.$en->image) }}" alt="" width="20%">
<br>

Judul : {{ $en->judul }} <br>
Kategori : {{ property_exists($en,'namacategory') ? $en->namacategory->nama_category : '' }} <br>
Deskripsi : {!! $en->deskripsi !!} <br>
Time : {{ $item->created_at }} <br>
Tags :
@foreach ($en->tags as $key => $item)
   {{ $item->tags }} |
@endforeach
{{-- {!! $en->tags !!} --}}
<br>

{{-- Nama Editor : {{ auth()->user()->name }}<br> --}}

<br>
</div>
<hr>
<br>
@endforeach

@else

<h3 >Belum Ada Data Perubahan</h3>

@endif


