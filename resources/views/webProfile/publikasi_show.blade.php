@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
<a href="{{ route('publikasiIndex') }}" class="btn btn-danger">Publikasi</a>
{!! $publikasiData['content'] !!}
@endsection