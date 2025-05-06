<head>
    <!-- jQuery tetap dibutuhkan -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Summernote versi lite (tanpa bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
</head>
<style>
.edit-dosen-container {
    max-width: 100%;
    margin: 20px;
    padding: 30px;
    background-color: #ffffff;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    border-radius: 20px;
    font-family: 'Segoe UI', sans-serif;
}

.title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 25px;
}

.error-message {
    background-color: #ffe5e5;
    color: #cc0000;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
}

.edit-dosen-form .form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.edit-dosen-form label {
    font-weight: 600;
    margin-bottom: 6px;
}

.edit-dosen-form input[type="text"],
.edit-dosen-form input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}

.gambar-preview {
    max-width: 200px;
    border-radius: 8px;
    margin-top: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

#summernote {
    margin-top: 5px;
}

.submit-button {
    background-color: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

.submit-button:hover {
    background-color: #218838;
}

</style>
<div class="edit-dosen-container">
    <h1 class="title">{{ $title }}</h1>

    @if(isset($error))
        <div class="error-message">
            {{ $error }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.artikel.update', ['id' => $artikelData['id']]) }}" enctype="multipart/form-data" class="edit-dosen-form">
        @csrf
        <input type="hidden" name="id" value="{{ $artikelData['id'] }}">

        <div class="form-group">
            <label for="nama">Judul Artikel :</label>
            <input type="text" name="nama" id="nama" value="{{ $artikelData['nama'] }}" required>
        </div>

        <div class="form-group">
            <label>Gambar Saat Ini</label>
            @if($artikelData['thumbnail'])
                <img src="{{ asset('storage/' . $artikelData['thumbnail']) }}" alt="Gambar Dosen" class="gambar-preview">
            @else
                <p><em>Belum ada gambar</em></p>
            @endif
        </div>

        <div class="form-group">
            <label for="image">Ganti Gambar (jika perlu)</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="summernote">Konten Profil Lengkap</label>
            <textarea id="summernote" name="content">{!! $artikelData['content'] !!}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button">Update Dosen</button>
        </div>
    </form>
</div>
@include('partials.summernote')
