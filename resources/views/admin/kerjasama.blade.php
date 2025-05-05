@extends('layouts.admin')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('admin.kerjasama.create') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nama">Judul Publikasi:</label>
        <input type="text" name="nama" required>
    </div>
    <div>
        <label for="image">Gambar:</label><br>
        <input type="file" name="image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Publikasi</button>
</form>

<hr>

<h2>Daftar Kerjasama</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kerjasamaData as $kerjasama)
        <tr>
            <td>
                @if($kerjasama['thumbnail'])
                    <img src="{{ asset('storage/' . $kerjasama['thumbnail']) }}" width="100">
                @endif
            </td>
            <td>{{ $kerjasama['nama'] }}</td>
            <td>
                <form action="{{ route('admin.kerjasama.delete', ['id' => $kerjasama['id']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('admin.kerjasama.edit', ['id' => $kerjasama['id']]) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
                <form action="{{ route('admin.kerjasama.publish', ['id' => $kerjasama['id'], 'status' => !$kerjasama['publish']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-secondary">{{ $kerjasama['publish'] ? 'Unpublish' : 'Publish' }}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
