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

        {{-- Form Edit Kerjasama --}}
        <form method="POST" action="{{ route('admin.kerjasama.update', ['id' => $kerjasamaData['id']]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $kerjasamaData['id'] }}">

            {{-- Judul --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="judul" name="nama" value="{{ $kerjasamaData['nama'] }}" placeholder="Judul Kerjasama" required>
                <label for="judul">Judul Kerjasama</label>
            </div>

            {{-- Gambar Saat Ini --}}
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                @if($kerjasamaData['thumbnail'])
                    <img src="{{ asset('storage/' . $kerjasamaData['thumbnail']) }}" alt="Gambar Kerjasama" class="img-thumbnail" style="max-height: 150px;">
                @else
                    <p><em>Belum ada gambar</em></p>
                @endif
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar (jika perlu)</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            {{-- Konten Lengkap --}}
            <div class="mb-3">
                <label for="summernote" class="form-label">Konten Lengkap</label>
                <textarea id="summernote" name="content">{!! $kerjasamaData['content'] ?? '' !!}</textarea>
            </div>

            {{-- Include Summernote --}}
            @include('partials.summernote')

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Kerjasama</button>
            </div>
        </form>
    </div>
</div>
@endsection
