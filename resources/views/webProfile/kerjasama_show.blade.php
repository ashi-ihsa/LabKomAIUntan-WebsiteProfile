<style>
/* Default (mobile): gambar penuh lebar, tinggi otomatis */
img.img-fluid {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}

/* Desktop (≥768px): pakai tinggi tetap */
@media (min-width: 768px) {
    img.img-fluid {
        height: 200px;
        width: auto;
    }
}
</style>

@extends('layouts.websiteProfile')
@section('content')
<main class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-1 mt-2">
        <ol class="breadcrumb">
             <li class="breadcrumb-item">
                <a href="{{ route('dosenIndex') }}">Beranda</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('kerjasamaIndex') }}">Kerjasama</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{$kerjasamaData['nama']}}</li>
        </ol>
    </nav>
    
    <div class="container" style="min-height: 575px;">
        <div>
            <img class="img-fluid d-block mx-auto"
                src="{{ asset('storage/' . $kerjasamaData['thumbnail']) }}"
                alt="Foto kerjasama">
        </div>
        <div class="my-4 text-center">
            <h2 class="fw-bold">{{$kerjasamaData['nama']}}</h2>
            <hr class="w-25 mx-auto">
        </div>
        <div class="card shadow-sm px-3 pt-3" style="min-height:360;">
            {!! $kerjasamaData['content'] !!}
        </div>
    </div>    
</main>
@endsection