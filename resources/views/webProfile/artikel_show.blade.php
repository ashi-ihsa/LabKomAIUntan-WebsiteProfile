@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
<a href="{{ route('artikelIndex') }}" class="btn btn-danger">Artikel</a>
{!! $artikelData['content'] !!}
@endsection