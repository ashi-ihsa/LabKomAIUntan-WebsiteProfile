@extends('layouts.admin')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('admin.publikasi.create') }}" enctype="multipart/form-data">
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
        <label for="tahun">Tahun:</label>
        <input type="number" name="tahun" required>
    </div>
    <div>
        <label for="dosen_id">Dosen:</label>
        <select name="dosen_id" required>
            <option value="">-- Pilih Dosen --</option>
            @foreach($dosenData as $dosen)
                <option value="{{ $dosen['id'] }}">{{ $dosen['nama'] }}</option>
            @endforeach
        </select>
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
            <th>Dosen</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($publikasiData as $publikasi)
        <tr>
            <td>
                @if($publikasi['thumbnail'])
                    <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}" width="100">
                @endif
            </td>
            <td>{{ $publikasi['nama'] }}</td>
            <td>{{ $publikasi['dosen_nama'] ?? '-' }}</td>
            <td>{{ $publikasi['tahun'] }}</td>
            <td>
                <form action="{{ route('admin.publikasi.delete', ['id' => $publikasi['id']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('admin.publikasi.edit', ['id' => $publikasi['id']]) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
                <form action="{{ route('admin.publikasi.highlight', ['id' => $publikasi['id'], 'status' => !$publikasi['highlight']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-info">{{ $publikasi['highlight'] ? 'Unhighlight' : 'Highlight' }}</button>
                </form>
                <form action="{{ route('admin.publikasi.publish', ['id' => $publikasi['id'], 'status' => !$publikasi['publish']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-secondary">{{ $publikasi['publish'] ? 'Unpublish' : 'Publish' }}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
