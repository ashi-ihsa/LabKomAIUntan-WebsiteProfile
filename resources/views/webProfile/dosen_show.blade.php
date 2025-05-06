@extends('layouts.websiteProfile')

@section('content')
<main class="show-container">
    <div class="breadcrumb-nav">
        <a href="{{ route('dosenIndex') }}">Beranda</a>
        <span class="breadcrumb-separator">&gt;</span>
        <span class="breadcrumb-nama">{{ $dosenData['nama'] }}</span>
    </div>

    <section class="content">
        {!! $dosenData['content'] !!}
    </section>
</main>
@endsection