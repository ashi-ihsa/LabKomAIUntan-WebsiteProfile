@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">Agenda</span>
    </div>

    <section class="content">
    <!-- Incoming Events Section -->
        <section class="incoming-events">
            <h2>Incoming Events</h2>
            @foreach($agendaData as $agenda)
                @if(!$agenda['sudah_lewat']) <!-- Events that are not passed -->
                    <div class="event-item">
                        @if($agenda['thumbnail'])
                            <img src="{{ asset('storage/' . $agenda['thumbnail']) }}" width="100" class="event-thumbnail">
                        @endif
                        <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="event-title">{{ $agenda['nama'] }}</a>
                        <p class="event-description">{{ $agenda['deskripsi'] }}</p>
                        <p class="event-date">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d-m-Y') }}</p>
                    </div>
                @endif
            @endforeach
        </section>

        <!-- Past Events Section -->
        <section class="past-events">
            <h2>Past Events</h2>
            @foreach($agendaData as $agenda)
                @if($agenda['sudah_lewat']) <!-- Events that are already passed -->
                    <div class="event-item">
                        @if($agenda['thumbnail'])
                            <img src="{{ asset('storage/' . $agenda['thumbnail']) }}" width="100" class="event-thumbnail">
                        @endif
                        <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="event-title">{{ $agenda['nama'] }}</a>
                        <p class="event-description">{{ $agenda['deskripsi'] }}</p>
                        <p class="event-date">{{ \Carbon\Carbon::parse($agenda['tanggal'])->format('d-m-Y') }}</p>
                    </div>
                @endif
            @endforeach
        </section>
    </section>
</main>
@endsection
