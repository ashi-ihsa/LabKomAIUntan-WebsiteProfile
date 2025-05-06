<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
</head>
<style>
    form {
  max-width: 100%;
  margin: 30px auto;
  background: #fff;
  padding: 25px 30px;
  border-radius: 12px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  font-size: 26px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  font-weight: bold;
  margin-bottom: 6px;
  color: #333;
}

.form-group input[type="text"],
.form-group input[type="date"],
.form-group input[type="file"] {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
}

.form-group img {
  max-width: 200px;
  border-radius: 8px;
  margin-top: 8px;
}

textarea#summernote {
  margin-top: 15px;
}

.btn-success {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
}

.btn-success:hover {
  background-color: #218838;
}

</style>
@if(session('error'))
    <div style="color: red; margin-bottom: 10px;">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.agenda.update', ['id' => $agendaData['id']]) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $agendaData['id'] }}">

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="nama" value="{{ $agendaData['nama'] }}" required>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="deskripsi" value="{{ $agendaData['deskripsi'] }}" required>
    </div>

    <div class="form-group">
        <label>Gambar Saat Ini:</label><br>
        @if($agendaData['thumbnail'])
            <img src="{{ asset('storage/' . $agendaData['thumbnail']) }}" alt="Gambar Agenda">
        @else
            <p><em>Belum ada gambar</em></p>
        @endif
    </div>

    <div class="form-group">
        <label>Ganti Gambar:</label>
        <input type="file" name="image" accept="image/*">
    </div>

    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="{{ $agendaData['tanggal'] }}" required>
    </div>

    <textarea id="summernote" name="content">{!! $agendaData['content'] ?? '' !!}</textarea>
    @include('partials.summernote')

    <div style="margin-top: 15px;">
        <button type="submit" class="btn btn-success">Update Agenda</button>
    </div>
</form>
