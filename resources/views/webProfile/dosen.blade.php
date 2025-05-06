@extends('layouts.websiteProfile')

@section('content')
<div class="carousel-container">
  <div class="carousel-wrapper">
    @foreach($dosenData as $index => $dosen)
    <div class="slide" data-slide>
      <div class="slide-content">
        <div class="slide-image">
          <img src="{{ asset('storage/' . $dosen['image']) }}" alt="{{ $dosen['nama'] }}">
        </div>
        <div class="slide-text">
          <h3>Mengenal Lebih Dekat Dosen Laboratorium Komputasi dan Kecerdasan Buatan</h3>
          <h4>{{ $dosen['nama'] }}</h4>
          <p>{{ $dosen['deskripsi'] }}</p>
          <a href="{{ route('dosenShow', ['id' => $dosen['id']]) }}">Baca Selengkapnya ➜</a>
        </div>
      </div>
    </div>
    @endforeach

    <button class="btn previous" data-button="previous"><i class="bi bi-chevron-left"></i></button>
    <button class="btn next" data-button="next"><i class="bi bi-chevron-right"></i></button>

    <div class="dots">
      @foreach($dosenData as $index => $dosen)
      <span class="dot" data-dot="{{ $index }}"></span>
      @endforeach
    </div>
  </div>
</div>
@endsection