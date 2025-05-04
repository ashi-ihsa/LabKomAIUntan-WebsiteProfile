<head>
    <!-- jQuery tetap dibutuhkan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote versi lite (tanpa bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
</head>
<h1>{{ $title }}</h1>

@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form method="POST" action="{{ route('admin.dosen.update', ['id' => $dosen['id']]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $dosen['id'] }}">

    <div>
        <label>Nama</label>
        <input type="text" name="nama" value="{{ $dosen['nama'] }}" required>
    </div>

    <div style="margin-top: 10px;">
        <label>Gambar Saat Ini:</label><br>
        @if($dosen['image'])
            <img src="{{ asset('storage/' . $dosen['image']) }}" alt="Gambar Dosen" style="max-width: 200px; height: auto;">
        @else
            <p><em>Belum ada gambar</em></p>
        @endif
    </div>

    <div style="margin-top: 10px;">
        <label>Ganti Gambar (jika perlu):</label><br>
        <input type="file" name="image" accept="image/*">
    </div>

    <div style="margin-top: 10px;">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" value="{{ $dosen['deskripsi'] }}" required>
    </div>

    <textarea id="summernote" name="content">{!! $dosen['content'] !!}</textarea>
    @include('partials.summernote')

    <div style="margin-top: 15px;">
        <button type="submit" class="btn btn-success">Update Dosen</button>
    </div>
</form>
