@extends('layouts.admin')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('admin.agenda.create') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nama">Judul Publikasi:</label>
        <input type="text" name="nama" required>
    </div>
    <div>
        <label for="image">Gambar:</label><br>
        <input type="file" name="image" accept="image/*" required>
    </div>
    <div>
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" name="deskripsi" required>
    </div>
    <div>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Publikasi</button>
</form>

<hr>

<h2>Daftar Publikasi</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($agendaData as $agenda)
        <tr>
            <td>
                @if($agenda['thumbnail'])
                    <img src="{{ asset('storage/' . $agenda['thumbnail']) }}" width="100">
                @endif
            </td>
            <td>{{ $agenda['nama'] }}</td>
            <td>{{ $agenda['tanggal'] }}</td>
            <td>
                <form action="{{ route('admin.agenda.delete', ['id' => $agenda['id']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('admin.agenda.edit', ['id' => $agenda['id']]) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
                <form action="{{ route('admin.agenda.lewat', ['id' => $agenda['id'], 'status' => !$agenda['sudah_lewat']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-secondary">{{ $agenda['sudah_lewat'] ? 'Unsudah_lewat' : 'sudah_lewat' }}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
