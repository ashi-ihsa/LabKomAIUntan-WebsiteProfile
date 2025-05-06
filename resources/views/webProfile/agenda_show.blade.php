@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <a href="{{ route('agendaIndex') }}">Agenda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">{{$agendaData['nama']}}</span>
    </div>

    <section class="content">
        {!! $agendaData['content'] !!}
    </section>
</main>
@endsection