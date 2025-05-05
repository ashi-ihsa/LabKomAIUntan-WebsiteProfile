@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
<a href="{{ route('kerjasamaIndex') }}" class="btn btn-danger">Kerjasama</a>
{!! $kerjasamaData['content'] !!}
@endsection