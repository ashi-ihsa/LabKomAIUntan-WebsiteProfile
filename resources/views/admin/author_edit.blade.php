<style>
    form {
  max-width: 600px;
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
.form-group input[type="email"],
.form-group input[type="password"] {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
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
<h1>{{ $title }}</h1>

@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif

<form action="{{ route('admin.author.update', ['id' => $author['id']]) }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $author['id'] }}">

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ $author['name'] }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="{{ $author['email'] }}" required>
    </div>

    <div class="form-group">
        <label>Password (Leave blank if not changing)</label>
        <input type="password" name="password">
    </div>

    <div style="margin-top: 15px;">
        <button type="submit" class="btn btn-success">Update Author</button>
    </div>
</form>
