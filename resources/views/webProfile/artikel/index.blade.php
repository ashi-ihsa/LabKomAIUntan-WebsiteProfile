<style>
@media (min-width: 768px) {
    .thumbnail-wrapper {
        height: 200px; /* atau ukuran tetap yang kamu inginkan */
        overflow: hidden;
    }
    .pagination {
        display: none;
    }
}

</style>
@extends('layouts.websiteProfile')
@section('content')
<main class="container show-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3 mt-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dosenIndex') }}">Beranda</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
        </ol>
    </nav>

    <!-- Search bar -->
    <form method="GET" action="" class="mb-3">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari berdasarkan judul atau dosen">
    </form>

    <!-- Layout untuk responsive -->
    <div class="row">
        <!-- Highlight di atas untuk mobile -->
        <div class="col-12 d-md-none mb-4">
            @include('webProfile.artikel._highlight', ['artikelData' => $artikelData])
        </div>

        <!-- Konten utama -->
        <div class="col-md-9">
            @include('webProfile.artikel._list', ['artikelData' => $artikelData])
        </div>

        <!-- Sidebar highlight untuk PC -->
        <div class="col-md-3 d-none d-md-block">
            @include('webProfile.artikel._highlight', ['artikelData' => $artikelData])
        </div>
    </div>
    <div class="text-center mt-3">
        {{-- Jika pakai Bootstrap 5 --}}
        {{ $artikelData->links('pagination::bootstrap-5') }}
    </div>

</main>

@endsection
