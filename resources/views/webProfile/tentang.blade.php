@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
<a href="{{ route('tentangIndex') }}" class="btn btn-danger">tentang</a>
{!! $tentangData !!}
@endsection