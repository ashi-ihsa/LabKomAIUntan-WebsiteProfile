@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <a href="{{ route('artikelIndex') }}">Artikel</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">{{$artikelData['nama']}}</span>
    </div>

    <section class="content">
        {!! $artikelData['content'] !!}
    </section>
</main>
@endsection