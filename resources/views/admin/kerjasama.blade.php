@extends('layouts.admin')
@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>
<div class="card shadow-sm mx-3">
    <h5 class="mx-3 mt-3">Tambah Kerjasama</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kerjasama.create') }}" enctype="multipart/form-data">
            @csrf

            {{-- Judul kerjasama --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="judul" name="nama" placeholder="Judul kerjasama" required>
                <label for="judul">Judul Kerjasama</label>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah Kerjasama</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm mx-3 my-3">
    <h5 class="mx-3 mt-3">Daftar Kerjasama</h5>

    {{-- Form Pencarian --}}
    <form method="GET" action="" class="mx-3 mb-3">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari berdasarkan judul kerjasama">
    </form>

    {{-- Grid kerjasama --}}
    <div class="row g-4 mx-1 mb-3">
        @foreach($kerjasamaData as $kerjasama)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">

                <div class="row g-0">
                    <div class="col-4 d-flex align-items-center">
                        @if($kerjasama['thumbnail'])
                            <img src="{{ asset('storage/' . $kerjasama['thumbnail']) }}"
                                alt="Thumbnail kerjasama"
                                class="img-fluid rounded-start w-100"
                                style="aspect-ratio: 1/1; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-8">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            {{-- Judul kerjasama --}}
                            <h6 class="card-title">{{ $kerjasama['nama'] ?? 'Judul kerjasama' }}</h6>

                            {{-- Tombol Aksi --}}
                            <div class="mt-auto align-self-end">
                                <form action="{{ route('admin.kerjasama.publish', ['id' => $kerjasama['id'], 'status' => !$kerjasama['publish']]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info w-28">
                                        {{ $kerjasama['publish'] ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                            </div>
                            <div class="mt-1 align-self-end">
                                <form action="{{ route('admin.kerjasama.edit', ['id' => $kerjasama['id']]) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-28">Edit</button>
                                </form>
                                <form action="{{ route('admin.kerjasama.delete', ['id' => $kerjasama['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kerjasama ini?');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger w-28">Hapus</button>
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
