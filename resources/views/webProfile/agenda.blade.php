<style>
    .agenda-thumbnail {
        object-fit: cover;
        object-position: center;
        width: 100%;
    }

    /* Di layar besar: persegi */
    @media (min-width: 768px) {
        .agenda-thumbnail {
            aspect-ratio: 1 / 1;
        }
    }

    /* Di layar kecil (HP): tinggi otomatis sesuai gambar */
    @media (max-width: 767.98px) {
        .agenda-thumbnail {
            height: auto;
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
            <li class="breadcrumb-item active" aria-current="page">Agenda</li>
        </ol>
    </nav>

    <section class="content">
    <!-- Incoming Events Section -->
    
    <h2 class="text-center my-4">Incoming Events</h2>
    <hr class="w-25 mx-auto">
    <div class="row pb-3">
        @foreach($agendaData as $agenda)
            @if(!$agenda['sudah_lewat'])
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($agenda['thumbnail'])
                            <img src="{{ asset('storage/' . $agenda['thumbnail']) }}"
                                class="card-img-top agenda-thumbnail"
                                alt="{{ $agenda['nama'] }}">    
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="text-decoration-none text-dark">
                                    {{ $agenda['nama'] }}
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($agenda['deskripsi'], 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d-m-Y') }}</small></p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

        

    <!-- Past Events Section -->
    <h2 class="text-center my-4">Past Events</h2>
    <hr class="w-25 mx-auto">
    <div class="row pb-3">
        @foreach($agendaData as $agenda)
            @if($agenda['sudah_lewat'])
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($agenda['thumbnail'])
                            <img src="{{ asset('storage/' . $agenda['thumbnail']) }}"
                                class="card-img-top agenda-thumbnail"
                                alt="{{ $agenda['nama'] }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="text-decoration-none text-dark">
                                    {{ $agenda['nama'] }}
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1">{{ \Illuminate\Support\Str::limit($agenda['deskripsi'], 100) }}</p>
                            <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d-m-Y') }}</small></p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    </section>
</main>
@endsection
