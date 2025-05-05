@extends('layouts.websiteProfile')

@section('content')
@foreach($agendaData as $agenda)
    @if($agenda['sudah_lewat'])
        @if($agenda['thumbnail'])
            <img src="{{ asset('storage/' . $agenda['thumbnail']) }}" width="100">
        @endif
        <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="btn btn-danger">{{ $agenda['nama'] }}</a>
        <p>{{ $agenda['nama'] }}</p>
        <p>{{ $agenda['deskripsi'] }}</p>
        <p>{{ $agenda['tanggal'] }}</p>
    @endif
@endforeach
<h1>pembatas</h1>
@foreach($agendaData as $agenda)
    @if(!$agenda['sudah_lewat'])
        <a href="{{ route('agendaShow', ['id' => $agenda['id']]) }}" class="btn btn-danger">{{ $agenda['nama'] }}</a>
    @endif
@endforeach
@endsection