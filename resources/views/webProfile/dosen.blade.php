@extends('layouts.websiteProfile')

@section('content')
<h2>Daftar Dosen</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dosenData as $dosen)
        <tr>
            <td>
                @if($dosen['image'])
                    <img src="{{ asset('storage/' . $dosen['image']) }}" width="100">
                @endif
            </td>
            <td>{{ $dosen['nama'] }}</td>
            <td>{{ $dosen['deskripsi'] }}</td>
            <td>
                <a href="{{ route('dosenShow', ['id' => $dosen['id']]) }}" class="btn btn-danger">Pergi</a>
            </td>          
        </tr>
        @endforeach
    </tbody>
</table>
@endsection