@extends('layouts.websiteProfile')
@section('content')
<main class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3 mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dosenIndex') }}">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tentang</li>
        </ol>
    </nav>

    <!-- Judul Halaman -->
    <div class="my-4 text-center">
        <h2 class="fw-bold">Tentang Kami</h2>
        <p class="text-muted">Profil dan informasi mengenai Laboratorium Komputasi dan Kecerdasan Buatan</p>
        <hr class="w-25 mx-auto">
    </div>

    <!-- Konten dari Summernote -->
    <div class="card shadow-sm px-3 pt-3" style="min-height:470px;">
        {!! $tentangData !!}
    </div>
</main>
@endsection