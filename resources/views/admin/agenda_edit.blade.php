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

        {{-- Form Edit --}}
        <form method="POST" action="{{ route('admin.agenda.update', ['id' => $agendaData['id']]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $agendaData['id'] }}">

            {{-- Judul --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="judul" name="nama" value="{{ $agendaData['nama'] }}" placeholder="Judul Agenda" required>
                <label for="judul">Judul Agenda</label>
            </div>

            {{-- Deskripsi --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $agendaData['deskripsi'] }}" placeholder="Deskripsi" required>
                <label for="deskripsi">Deskripsi Singkat</label>
            </div>

            {{-- Gambar Saat Ini --}}
            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini:</label><br>
                @if($agendaData['thumbnail'])
                    <img src="{{ asset('storage/' . $agendaData['thumbnail']) }}" alt="Gambar Agenda" class="img-thumbnail" style="max-height: 150px;">
                @else
                    <p><em>Belum ada gambar</em></p>
                @endif
            </div>

            {{-- Upload Gambar Baru --}}
            <div class="mb-3">
                <label for="image" class="form-label">Ganti Gambar</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $agendaData['tanggal'] }}" required>
            </div>

            {{-- Konten (Summernote) --}}
            <div class="mb-3">
                <label for="summernote" class="form-label">Konten Lengkap</label>
                <textarea id="summernote" name="content">{!! $agendaData['content'] ?? '' !!}</textarea>
            </div>

            {{-- Include Summernote --}}
            @include('partials.summernote')

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Agenda</button>
            </div>
        </form>
    </div>
</div>

@endsection