@extends('layouts.websiteProfile')

@section('content')
<a href="{{ route('dosenIndex') }}" class="btn btn-danger">Beranda</a>
<a href="{{ route('agendaIndex') }}" class="btn btn-danger">Agenda</a>
{!! $agendaData['content'] !!}
@endsection