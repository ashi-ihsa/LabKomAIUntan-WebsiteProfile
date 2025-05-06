@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <a href="{{ route('kerjasamaIndex') }}">Kerjasama</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">{{$kerjasamaData['nama']}}</span>
    </div>

    <section class="content">
        {!! $kerjasamaData['content'] !!}
    </section>
</main>
@endsection