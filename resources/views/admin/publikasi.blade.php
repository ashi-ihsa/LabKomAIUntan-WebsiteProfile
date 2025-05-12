@extends('layouts.admin')

@section('content')
<div class="cardBox formCard">
    <div class="card">
        <div class="cardHeader">
            <h2>Tambah Publikasi</h2>
        </div>
            <form method="POST" action="{{ route('admin.publikasi.create') }}" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label for="nama">Judul Publikasi:</label>
                    <input type="text" name="nama" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="image">Gambar:</label><br>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="deskripsi">Deskripsi:</label>
                    <input type="text" name="deskripsi" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="tahun">Tahun:</label>
                    <input type="number" name="tahun" required>
                </div>
                <div style="margin-bottom: 15px;">
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
    </div>
</div>

<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Publikasi</h2>
    <div class="grid-dosen">
        @foreach($publikasiData as $publikasi)
        <div class="card-dosen">
            <div class="gambar-dosen">
                <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}" alt="Foto Dosen">
            </div>
            <div class="konten-dosen">
                <div class="nama-dosen">
                    <h4>{{ $publikasi['nama'] ?? 'Judul Publikasi' }}</h1>
                    <p>{{ $publikasi['dosen_nama'] ?? '-' }} 
                        {{ $publikasi['tahun']}}</p>
                </div>
                <div class="aksi-dosen">
                    <form action="{{ route('admin.publikasi.highlight', ['id' => $publikasi['id'], 'status' => !$publikasi['highlight']]) }}" method="POST">
                        @csrf
                        <button class="btn-highlight">{{ $publikasi['highlight'] ? 'Unhighlight' : 'Highlight' }}</button>
                    </form>
                    <form action="{{ route('admin.publikasi.publish', ['id' => $publikasi['id'], 'status' => !$publikasi['publish']]) }}" method="POST">
                        @csrf
                        <button class="btn-publish">{{ $publikasi['publish'] ? 'Unpublish' : 'Publish' }}</button>
                    </form>
                </div>
                <div class="aksi-dosen">
                    <form action="{{ route('admin.publikasi.edit', ['id' => $publikasi['id']]) }}" method="GET">
                        @csrf
                        <button class="btn-edit">Edit</button>
                    </form>
                    <form action="{{ route('admin.publikasi.delete', ['id' => $publikasi['id']]) }}" method="POST">
                        @csrf
                        <button class="btn-hapus">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
