@extends('layouts.websiteProfile')

@section('content')
<main class="container show-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3 mt-2">
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

    <section class="content">
        {!! $agendaData['content'] !!}
    </section>
</main>
@endsection