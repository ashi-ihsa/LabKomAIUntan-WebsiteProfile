@extends('layouts.admin')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('admin.artikel.create') }}" enctype="multipart/form-data">
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
                <form action="{{ route('admin.artikel.delete', ['id' => $artikel['id']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="{{ route('admin.artikel.edit', ['id' => $artikel['id']]) }}" method="GET" style="display:inline;">
                    @csrf
                    <button class="btn btn-warning">Edit</button>
                </form>
                <form action="{{ route('admin.artikel.highlight', ['id' => $artikel['id'], 'status' => !$artikel['highlight']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-info">{{ $artikel['highlight'] ? 'Unhighlight' : 'Highlight' }}</button>
                </form>
                <form action="{{ route('admin.artikel.publish', ['id' => $artikel['id'], 'status' => !$artikel['publish']]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-secondary">{{ $artikel['publish'] ? 'Unpublish' : 'Publish' }}</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
