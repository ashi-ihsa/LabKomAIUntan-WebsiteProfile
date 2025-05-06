@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">Kerjasama</span>
    </div>

    <section class="content">
        <div class="kerjasama-container">
            @foreach($kerjasamaData as $kerjasama)
                @if($kerjasama['publish'])
                    <div class="kerjasama-item">
                        <!-- Gambar Kerjasama -->
                        @if($kerjasama['thumbnail'])
                            <img src="{{ asset('storage/' . $kerjasama['thumbnail']) }}" class="kerjasama-thumbnail">
                        @endif
                        <!-- Nama Kerjasama -->
                        <a href="{{ route('kerjasamaShow', ['id' => $kerjasama['id']]) }}" class="kerjasama-name">{{ $kerjasama['nama'] }}</a>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</main>
@endsection
