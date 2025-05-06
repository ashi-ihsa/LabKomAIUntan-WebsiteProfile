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
            <h2>Tambah Agenda</h2>
        </div>
        <form method="POST" action="{{ route('admin.agenda.create') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="nama">Judul agenda:</label>
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
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah agenda</button>
        </form>
    </div>
</div>

<!-- KOTAK BESAR -->
<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Agenda</h2>
    <div class="grid-dosen">
    @foreach($agendaData as $agenda)
    <div class="card-dosen">
            <div class="gambar-dosen">
                <img src="{{ asset('storage/' . $agenda['thumbnail']) }}" alt="Foto Dosen">
            </div>
            <div class="konten-dosen">
                <div class="nama-dosen">
                    <h1>{{ $agenda['nama'] }}</h1>
                    <p>{{ $agenda['tanggal']}}</p>
                </div>
                <div class="aksi-dosen">
                    <form action="{{ route('admin.agenda.lewat', ['id' => $agenda['id'], 'status' => !$agenda['sudah_lewat']]) }}" method="POST">
                        @csrf
                        <button class="btn-highlight">{{ $agenda['sudah_lewat'] ? 'belum lewat' : 'sudah lewat' }}</button>
                    </form>
                </div>
                <div class="aksi-dosen">
                    <form action="{{ route('admin.agenda.edit', ['id' => $agenda['id']]) }}" method="GET">
                        @csrf
                        <button class="btn-edit">Edit</button>
                    </form>
                    <form action="{{ route('admin.agenda.delete', ['id' => $agenda['id']]) }}" method="POST">
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
