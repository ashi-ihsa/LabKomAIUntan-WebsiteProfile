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
                <a href="{{ route('agendaIndex') }}">Agenda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{$agendaData['nama']}}</li>
        </ol>
    </nav>
    
    <div class="container" style="min-height: 575px;">
        <div>
            <img class="img-fluid d-block mx-auto"
                src="{{ asset('storage/' . $agendaData['thumbnail']) }}"
                alt="Foto agenda">
        </div>
        <div class="my-4 text-center">
            <h2 class="fw-bold">{{$agendaData['nama']}}</h2>
            <p class="text-muted">{{$agendaData['tanggal']}}</p>
            <hr class="w-25 mx-auto">
        </div>
        <div class="card shadow-sm px-3 pt-3" style="min-height:360;">
            {!! $agendaData['content'] !!}
        </div>
    </div>    
</main>
@endsection