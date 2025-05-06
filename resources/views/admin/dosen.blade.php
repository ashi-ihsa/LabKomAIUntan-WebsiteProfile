@extends('layouts.admin')

@section('content')
<div class="cardBox formCard">
    <div class="card">
        <div class="cardHeader">
            <h2>Tambah Dosen</h2>
        </div>
        <form method="POST" action="{{ route('admin.dosen.create') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="image">Gambar (Upload File):</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="deskripsi">Deskripsi Singkat:</label>
                <input type="text" name="deskripsi" required>
            </div>
            <button type="submit">Tambah Dosen</button>
        </form>
    </div>
</div>

<!-- KOTAK BESAR -->
<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Dosen</h2>
    <div class="grid-dosen">
        @foreach($dosenData as $dosen)
        <div class="card-dosen">
            <div class="gambar-dosen">
                <img src="{{ asset('storage/' . $dosen['image']) }}" alt="Foto Dosen">
            </div>
            <div class="konten-dosen">
                <div class="nama-dosen">{{ $dosen['nama'] ?? 'Nama Dosen' }}</div>
                <div class="aksi-dosen">
                    <form action="{{ route('admin.dosen.edit', ['id' => $dosen['id']]) }}" method="GET">
                        @csrf
                        <button class="btn-edit">Edit</button>
                    </form>
                    <form action="{{ route('admin.dosen.delete', ['id' => $dosen['id']]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dosen ini?');">
                        @csrf
                        <button class="btn-hapus">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
