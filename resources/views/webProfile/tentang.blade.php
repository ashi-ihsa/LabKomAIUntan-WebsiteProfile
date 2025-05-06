@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">Tentang</span>
    </div>

    <section class="content">
        {!! $tentangData !!}
    </section>
</main>
@endsection