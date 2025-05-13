@extends('layouts.admin')
@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>
<div class="card shadow-sm mx-3">
    <h5 class="mx-3 mt-3">Tambah Publikasi</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.publikasi.create') }}" enctype="multipart/form-data">
            @csrf

            {{-- Judul Publikasi --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="judul" name="nama" placeholder="Judul Publikasi" required>
                <label for="judul">Judul Publikasi</label>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
            </div>

            {{-- Tahun dan Dosen (dalam 1 baris) --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required>
                        <label for="tahun">Tahun</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <select class="form-select" id="dosen_id" name="dosen_id" required>
                            <option value="" selected disabled>-- Pilih Dosen --</option>
                            @foreach($dosenData as $dosen)
                                <option value="{{ $dosen['id'] }}">{{ $dosen['nama'] }}</option>
                            @endforeach
                        </select>
                        <label for="dosen_id">Dosen</label>
                    </div>
                </div>
            </div>

            {{-- Deskripsi (textarea) --}}
            <div class="form-floating mb-4">
                <textarea class="form-control" placeholder="Deskripsi singkat" id="deskripsi" name="deskripsi" style="height: 100px" required></textarea>
                <label for="deskripsi">Deskripsi Singkat</label>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah Publikasi</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm mx-3 my-3">
    <h5 class="mx-3 mt-3">Daftar Publikasi</h5>

    {{-- Form Pencarian --}}
    <form method="GET" action="" class="mx-3 mb-3">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Cari berdasarkan judul atau dosen">
    </form>

    {{-- Grid Publikasi --}}
    <div class="row g-4 mx-1 mb-3">
        @foreach($publikasiData as $publikasi)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">

                <div class="row g-0">
                    <div class="col-4 d-flex align-items-center">
                        @if($publikasi['thumbnail'])
                            <img src="{{ asset('storage/' . $publikasi['thumbnail']) }}"
                                alt="Thumbnail Publikasi"
                                class="img-fluid rounded-start w-100"
                                style="aspect-ratio: 1/1; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-8">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            {{-- Judul Publikasi --}}
                            <h6 class="card-title">{{ $publikasi['nama'] ?? 'Judul Publikasi' }}</h6>

                            {{-- Dosen & Tahun --}}
                            <p class="mb-1 text-muted" style="font-size: 0.9rem;">
                                {{ $publikasi['dosen_nama'] ?? '-' }} &bull; {{ $publikasi['tahun'] }}
                            </p>

                            {{-- Tombol Aksi --}}
                            <div class="mt-auto align-self-end">
                                <form action="{{ route('admin.publikasi.highlight', ['id' => $publikasi['id'], 'status' => !$publikasi['highlight']]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning w-28">
                                        {{ $publikasi['highlight'] ? 'Unhighlight' : 'Highlight' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.publikasi.publish', ['id' => $publikasi['id'], 'status' => !$publikasi['publish']]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-info w-28">
                                        {{ $publikasi['publish'] ? 'Unpublish' : 'Publish' }}
                                    </button>
                                </form>
                            </div>
                            <div class="mt-1 align-self-end">
                                <form action="{{ route('admin.publikasi.edit', ['id' => $publikasi['id']]) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-28">Edit</button>
                                </form>
                                <form action="{{ route('admin.publikasi.delete', ['id' => $publikasi['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus publikasi ini?');">
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
