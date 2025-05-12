@extends('layouts.websiteProfile')

@section('content')
<div id="carouselDosen" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <!-- Indicators -->
  <div class="carousel-indicators">
    @foreach($dosenData as $index => $dosen)
      <button type="button"
              data-bs-target="#carouselDosen"
              data-bs-slide-to="{{ $index }}"
              class="{{ $index == 0 ? 'active' : '' }}"
              aria-current="{{ $index == 0 ? 'true' : 'false' }}"
              aria-label="Slide {{ $index + 1 }}">
      </button>
    @endforeach
  </div>

  <!-- Slides -->
  <div class="carousel-inner">
    @foreach($dosenData as $index => $dosen)
      <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center p-3 pb-5">
          <img src="{{ asset('storage/' . $dosen['image']) }}" alt="{{ $dosen['nama'] }}" class="img-fluid rounded shadow-sm me-md-4 mb-3 mb-md-0" style="max-width: auto; height: 420px;">
          <div class="text-center text-md-start">
            <h5 class="fw-bold">Mengenal Lebih Dekat Dosen Laboratorium Komputasi dan Kecerdasan Buatan</h5>
            <h6 class="text-primary">{{ $dosen['nama'] }}</h6>
            <p>{{ $dosen['deskripsi'] }}</p>
            <a href="{{ route('dosenShow', ['id' => $dosen['id']]) }}" class="btn btn-outline-primary btn-sm mt-2">Baca Selengkapnya ➜</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#carouselDosen" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Sebelumnya</span>
  </button>
  <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#carouselDosen" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Selanjutnya</span>
  </button>
</div>
@endsection