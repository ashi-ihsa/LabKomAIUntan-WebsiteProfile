@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">Artikel</span>
    </div>

    <section class="content">
    <div class="main-content">
        <!-- Menampilkan daftar publikasi -->
        <div class="publications">
            @foreach($artikelData as $artikel)
                @if($artikel['publish'] && $artikel['highlight'])
                    <div class="publication-item">
                        <!-- Thumbnail -->
                        @if($artikel['thumbnail'])
                            <img src="{{ asset('storage/' . $artikel['thumbnail']) }}" class="publication-thumbnail">
                        @endif
                        <!-- Nama dan Deskripsi Publikasi -->
                        <div class="publication-details">
                            <a href="{{ route('publikasiShow', ['id' => $artikel['id']]) }}" class="publication-title">{{ $artikel['nama'] }}</a>
                            <p class="publication-year">{{ \Carbon\Carbon::parse($artikel['created_at'])->format('d-m-Y') }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Sidebar untuk Highlight Agenda -->
    <div class="sidebar">
        <h2>Highlight Artikel</h2>
        <div class="highlight-agenda">
            @foreach($artikelData as $artikel)
                @if($artikel['publish'] && $artikel['highlight'])
                    <div class="highlight-item">
                        <a href="{{ route('publikasiShow', ['id' => $artikel['id']]) }}" class="highlight-item">{{ $artikel['nama'] }}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    </section>
</main>
@endsection