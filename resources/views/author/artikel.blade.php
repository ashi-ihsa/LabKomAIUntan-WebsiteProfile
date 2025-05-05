@extends('layouts.author')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('author.artikel.create') }}" enctype="multipart/form-data">
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

<h2>Daftar Publikasi</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($artikelData as $artikel)
        <tr>
            <td>
                @if($artikel['thumbnail'])
                    <img src="{{ asset('storage/' . $artikel['thumbnail']) }}" width="100">
                @endif
            </td>
            <td>{{ $artikel['nama'] }}</td>
            <td>
                <form action="{{ route('author.artikel.delete', ['id' => $artikel['id']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('author.artikel.edit', ['id' => $artikel['id']]) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
