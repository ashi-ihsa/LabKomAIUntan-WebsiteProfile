@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">Publikasi</span>
    </div>

    <section class="content">
    <div class="main-content">
        <!-- Menampilkan daftar publikasi -->
        <div class="publications">
            @foreach($publikasiData as $publikasi)
                @if($publikasi['publish'])
                    <div class="publication-item">
                        <!-- Thumbnail -->
                        @if($publikasi['thumbnail'])
                            <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}" class="publication-thumbnail">
                        @endif
                        <!-- Nama dan Deskripsi Publikasi -->
                        <div class="publication-details">
                            <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="publication-title">{{ $publikasi['nama'] }}</a>
                            <p class="publication-author">{{ $publikasi['dosen_nama'] }}</p>
                            <p class="publication-description">{{ $publikasi['deskripsi'] }}</p>
                            <p class="publication-year">{{ $publikasi['tahun'] }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Sidebar untuk Highlight Agenda -->
    <div class="sidebar">
        <h2>Highlight Publikasi</h2>
        <div class="highlight-agenda">
            @foreach($publikasiData as $publikasi)
                @if($publikasi['publish'] && $publikasi['highlight'])
                    <div class="highlight-item">
                        <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="highlight-item">{{ $publikasi['nama'] }}</a>
                        <p class="highlight-author">{{ $publikasi['dosen_nama'] }} - {{ $publikasi['tahun'] }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    </section>
</main>
@endsection
