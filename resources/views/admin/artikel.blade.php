@extends('layouts.admin')

@section('content')
<div class="cardBox formCard">
    <div class="card">
        <div class="cardHeader">
            <h2>Tambah Artikel</h2>
        </div>
        <form method="POST" action="{{ route('admin.artikel.create') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="image">Gambar (Upload File):</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit">Tambah Artikel</button>
        </form>
    </div>
</div>

<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Artikel</h2>
    <div class="grid-dosen">
        @foreach($artikelData as $artikel)
        <div class="card-dosen">
            <div class="gambar-dosen">
                    <img src="{{ asset('storage/' . $artikel['thumbnail']) }}" alt="Thumbnail">
            </div>
            <div class="konten-dosen">
                <div class="nama-dosen">{{ $artikel['nama'] }}</div>
                    <div class="aksi-dosen">
                        <form action="{{ route('admin.artikel.highlight', ['id' => $artikel['id'], 'status' => !$artikel['highlight']]) }}" method="POST">
                            @csrf
                            <button class="btn-highlight">{{ $artikel['highlight'] ? 'Unhighlight' : 'Highlight' }}</button>
                        </form>
                        <form action="{{ route('admin.artikel.publish', ['id' => $artikel['id'], 'status' => !$artikel['publish']]) }}" method="POST">
                            @csrf
                            <button class="btn-publish">{{ $artikel['publish'] ? 'Unpublish' : 'Publish' }}</button>
                        </form>
                    </div>
                    <div class="aksi-dosen">
                        <form action="{{ route('admin.artikel.edit', ['id' => $artikel['id']]) }}" method="GET">
                            @csrf
                            <button class="btn-edit">Edit</button>
                        </form>
                        <form action="{{ route('admin.artikel.delete', ['id' => $artikel['id']]) }}" method="POST">
                            @csrf
                            <button class="btn-hapus">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
