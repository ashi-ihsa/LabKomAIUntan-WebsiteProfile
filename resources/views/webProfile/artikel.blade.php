@extends('layouts.websiteProfile')

@section('content')
@foreach($artikelData as $artikel)
    @if($artikel['publish'])
        @if($artikel['thumbnail'])
            <img src="{{ asset('storage/' . $artikel['thumbnail']) }}" width="100">
        @endif
        <a href="{{ route('artikelShow', ['id' => $artikel['id']]) }}" class="btn btn-danger">{{ $artikel['nama'] }}</a>
        <p>{{ $artikel['created_at'] }}</p>
    @endif
@endforeach
<h1>pembatas</h1>
@foreach($artikelData as $artikel)
    @if($artikel['publish'] && $artikel['highlight'])
        <a href="{{ route('artikelShow', ['id' => $artikel['id']]) }}" class="btn btn-danger">{{ $artikel['nama'] }}</a>
    @endif
@endforeach
@endsection