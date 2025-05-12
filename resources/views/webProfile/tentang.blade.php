@extends('layouts.websiteProfile')

@section('content')
<main class="container show-container">
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
    <section class="content bg-white p-4 rounded shadow-sm">
        <div class="summernote-content">
            {!! $tentangData !!}
        </div>
    </section>
</main>

@push('styles')
<style>
    .summernote-content {
        font-family: 'Segoe UI', sans-serif;
        font-size: 1rem;
        line-height: 1.75;
    }

    .summernote-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.25rem;
        margin: 1rem 0;
    }

    .summernote-content iframe {
        max-width: 100%;
    }

    .summernote-content h1,
    .summernote-content h2,
    .summernote-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .summernote-content p {
        margin-bottom: 1rem;
    }

    .summernote-content ul,
    .summernote-content ol {
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }

    .summernote-content blockquote {
        padding: 1rem;
        margin: 1rem 0;
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
        font-style: italic;
    }
</style>
@endpush
@endsection
