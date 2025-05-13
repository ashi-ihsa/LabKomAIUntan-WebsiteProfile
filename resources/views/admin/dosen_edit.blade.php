@extends('layouts.admin')

@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>

<div class="card shadow-sm mx-3 mb-3">
    <div class="card-body">

        {{-- Notifikasi Error --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Edit Dosen --}}
        <form method="POST" action="{{ route('admin.dosen.update', ['id' => $dosen['id']]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $dosen['id'] }}">

            {{-- Nama --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $dosen['nama'] }}" placeholder="Nama Dosen" required>
                <label for="nama">Nama Dosen</label>
            </div>

            {{-- Gambar Saat Ini --}}
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                @if($dosen['image'])
                    <img src="{{ asset('storage/' . $dosen['image']) }}" alt="Gambar Dosen" class="img-thumbnail" style="max-height: 150px;">
                @else
                    <p><em>Belum ada gambar</em></p>
                @endif
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar (jika perlu)</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $dosen['deskripsi'] }}</textarea>
            </div>

            {{-- Konten Lengkap --}}
            <div class="mb-3">
                <label for="summernote" class="form-label">Konten Profil Lengkap</label>
                <textarea id="summernote" name="content">{!! $dosen['content'] ?? '' !!}</textarea>
            </div>

            {{-- Include Summernote --}}
            @include('partials.summernote')

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Dosen</button>
            </div>
        </form>
    </div>
</div>
@endsection
