@extends('layouts.admin')
@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>
<div class="card shadow-sm mx-3 ">
    <h5 class="mx-3 mt-3">Tambah Dosen</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.dosen.create') }}" enctype="multipart/form-data">
            @csrf
            {{-- Nama --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Dosen" required>
                <label for="nama">Nama</label>
            </div>
            {{-- Gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar (Upload File)</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            {{-- Deskripsi --}}
            <div class="form-floating mb-4">
                <textarea class="form-control" placeholder="Deskripsi singkat" id="deskripsi" name="deskripsi" style="height: 100px" required></textarea>
                <label for="deskripsi">Deskripsi Singkat</label>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah Dosen</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm mx-3 my-3">
    <h5 class="mx-3 mt-3">Daftar Dosen</h5>
    <form method="GET" action="" class="mx-3 mb-3 ">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari berdasarkan nama">
    </form>
    <div class="row g-4 mx-1 mb-3">
        @foreach($dosenData as $dosen)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">

                <div class="row g-0">
                    <div class="col-4 d-flex align-items-center">
                        <img src="{{ asset('storage/' . $dosen['image']) }}" alt="Foto Dosen" class="img-fluid rounded-start w-100" style="aspect-ratio: 1/1; object-fit: cover;">
                    </div>
                    <div class="col-8">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            <h6 class="card-title">{{ $dosen['nama'] ?? 'Nama Dosen' }}</h6>
                            <div class="mt-auto align-self-end">
                                <form action="{{ route('admin.dosen.edit', ['id' => $dosen['id']]) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </form>
                                <form action="{{ route('admin.dosen.delete', ['id' => $dosen['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dosen ini?');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
