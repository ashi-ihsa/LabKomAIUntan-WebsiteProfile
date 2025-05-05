@extends('layouts.websiteProfile')

@section('content')
@foreach($publikasiData as $publikasi)
    @if($publikasi['publish'])
        @if($publikasi['thumbnail'])
            <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}" width="100">
        @endif
        <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="btn btn-danger">{{ $publikasi['nama'] }}</a>
        <p>{{ $publikasi['dosen_nama'] }}</p>
        <p>{{ $publikasi['deskripsi'] }}</p>
        <p>{{ $publikasi['tahun'] }}</p>
    @endif
@endforeach
<h1>pembatas</h1>
@foreach($publikasiData as $publikasi)
    @if($publikasi['publish'] && $publikasi['highlight'])
        <a href="{{ route('publikasiShow', ['id' => $publikasi['id']]) }}" class="btn btn-danger">{{ $publikasi['nama'] }}</a>
    @endif
@endforeach
@endsection