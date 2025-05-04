@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('admin.dosen.create') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
    </div>
    <div>
        <label for="image">Gambar (Upload File):</label><br>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>
    <div>
        <label for="deskripsi">Deskripsi Singkat:</label>
        <input type="text" name="deskripsi" required>
    </div>
    <button type="submit" class="btn btn-success">Tambah Dosen</button>
</form>

<hr>

<h2>Daftar Dosen</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
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
            <td>
                <form action="{{ route('admin.dosen.delete', ['id' => $dosen['id']]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('admin.dosen.edit', ['id' => $dosen['id']]) }}" method="GET">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection