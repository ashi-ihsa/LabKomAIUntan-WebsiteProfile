@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
{!! $dosenData['content'] !!}
@endsection