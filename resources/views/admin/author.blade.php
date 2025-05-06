@extends('layouts.admin')

@section('content')
<div class="cardBox formCard">
    <div class="card">
        <div class="cardHeader">
            <h2>Tambah Dosen</h2>
        </div>
        <form method="POST" action="{{ route('admin.author.create')}}">
            @csrf
            <div style="margin-bottom: 10px;">
                <label for="name">Nama:</label><br>
                <input type="text" name="name" id="name" required>
            </div>
            <div style="margin-bottom: 10px;">
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <div style="margin-bottom: 10px;">
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <button type="submit" class="btn btn-success">Tambah Author</button>
            </div>
        </form>
    </div>
</div>

<div class="container-dosen">
    <h2 class="judul-dosen">Daftar Dosen</h2>
    <div class="grid-dosen">
    @foreach($authorData as $author)
        <div class="card-dosen">
            <div class="nama-dosen">{{ $author['name']}}</div>
            <div class="aksi-dosen">
                <form action="{{ route('admin.author.edit', ['id' => $author['id']]) }}" method="GET">
                    @csrf
                    <button class="btn-edit">Edit</button>
                </form>
                <form action="{{ route('admin.author.delete', ['id' => $author['id']]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dosen ini?');">
                    @csrf
                    <button class="btn-hapus">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection