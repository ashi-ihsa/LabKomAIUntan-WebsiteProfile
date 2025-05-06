@extends('layouts.admin')

@section('content')
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif
<div class="cardBox formCard">
    <div class="card">
        <div class="cardHeader">
            <h2>Tambah Publikasi</h2>
        </div>
            <form method="POST" action="{{ route('admin.kerjasama.create') }}" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label for="nama">Judul Publikasi:</label>
                    <input type="text" name="nama" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="image">Gambar:</label><br>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Publikasi</button>
            </form>
    </div>
</div>

<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Kerjasama</h2>
    <div class="grid-dosen">
        @foreach($kerjasamaData as $kerjasama)
        <div class="card-dosen">
            <div class="gambar-dosen">
                <img src="{{ asset('storage/' . $kerjasama['thumbnail']) }}" alt="Foto Dosen">
            </div>
            <div class="konten-dosen">
                <div class="nama-dosen">
                    <h1>{{$kerjasama['nama']}}</h1>
                </div>
            </div>
            <div class="aksi-dosen">
                <form action="{{ route('admin.kerjasama.edit', ['id' => $kerjasama['id']]) }}" method="GET">
                    @csrf
                    <button class="btn-edit">Edit</button>
                </form>
                <form action="{{ route('admin.kerjasama.delete', ['id' => $kerjasama['id']]) }}" method="POST">
                    @csrf
                    <button class="btn-hapus">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
