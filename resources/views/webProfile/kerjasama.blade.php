@extends('layouts.websiteProfile')

@section('content')
@foreach($kerjasamaData as $kerjasama)
    @if($kerjasama['publish'])
        @if($kerjasama['thumbnail'])
            <img src="{{ asset('storage/' . $kerjasama['thumbnail']) }}" width="100">
        @endif
        <a href="{{ route('kerjasamaShow', ['id' => $kerjasama['id']]) }}" class="btn btn-danger">{{ $kerjasama['nama'] }}</a>
    @endif
@endforeach
@endsection