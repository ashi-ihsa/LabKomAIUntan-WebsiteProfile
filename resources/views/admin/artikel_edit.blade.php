<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
</head>
<h1>{{ $title }}</h1>

@if(session('error'))
    <div style="color: red; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.artikel.update', ['id' => $artikelData['id']]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $artikelData['id'] }}">

    <div>
        <label>Judul</label>
        <input type="text" name="nama" value="{{ $artikelData['nama'] }}" required>
    </div>

    <div>
        <label>Gambar Saat Ini:</label><br>
        @if($artikelData['thumbnail'])
            <img src="{{ asset('storage/' . $artikelData['thumbnail']) }}" alt="Gambar Publikasi" style="max-width: 200px;">
        @else
            <p><em>Belum ada gambar</em></p>
        @endif
    </div>

    <div>
        <label>Ganti Gambar:</label>
        <input type="file" name="image" accept="image/*">
    </div>

    <textarea id="summernote" name="content">{!! $artikelData['content'] ?? '' !!}</textarea>
    @include('partials.summernote')

    <div style="margin-top: 15px;">
        <button type="submit" class="btn btn-success">Update Publikasi</button>
    </div>
</form>
