@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <a href="{{ route('publikasiIndex') }}">Publikasi</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">{{$publikasiData['nama']}}</span>
    </div>

    <section class="content">
        {!! $publikasiData['content'] !!}
    </section>
</main>
@endsection