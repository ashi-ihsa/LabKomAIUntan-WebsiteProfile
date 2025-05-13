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

        {{-- Form Edit Publikasi --}}
        <form method="POST" action="{{ route('admin.publikasi.update', ['id' => $publikasiData['id']]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $publikasiData['id'] }}">

            {{-- Judul --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="judul" name="nama" value="{{ $publikasiData['nama'] }}" placeholder="Judul Publikasi" required>
                <label for="judul">Judul Publikasi</label>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                @if($publikasiData['thumbnail'])
                    <img src="{{ asset('storage/' . $publikasiData['thumbnail']) }}" alt="Gambar Publikasi" class="img-thumbnail" style="max-height: 150px;">
                @else
                    <p><em>Belum ada gambar</em></p>
                @endif
            </div>
            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar (jika perlu)</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            <div class="row mb-3">
                {{-- Dosen Terkait --}}
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="dosen_id" class="form-label">Dosen Terkait</label>
                    <select class="form-select" name="dosen_id" id="dosen_id" required>
                        @foreach($dosenData as $dosen)
                            <option value="{{ $dosen['id'] }}" {{ $publikasiData['dosen_id'] == $dosen['id'] ? 'selected' : '' }}>
                                {{ $dosen['nama'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun Publikasi --}}
                <div class="col-md-6">
                    <div class="form-floating h-100" style="margin-top: 11px;">
                        <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $publikasiData['tahun'] }}" placeholder="Tahun Publikasi" required>
                        <label for="tahun">Tahun Publikasi</label>
                    </div>
                </div>
            </div>

            {{-- Deskripsi (Textarea) --}}
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $publikasiData['deskripsi'] }}</textarea>
            </div>

            {{-- Konten Lengkap --}}
            <div class="mb-3">
                <label for="summernote" class="form-label">Konten Lengkap</label>
                <textarea id="summernote" name="content">{!! $publikasiData['content'] ?? '' !!}</textarea>
            </div>

            {{-- Include Summernote --}}
            @include('partials.summernote')

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Publikasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
