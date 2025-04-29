<h1>{{$title}}</h1>
@if(isset($error))
    <div style="color: red; margin-bottom: 10px;">
        {{ $error }}
    </div>
@endif
<form action="/admin/author/{{$author['id']}}/update" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $author['id'] }}">
    
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ $author['name'] }}" required>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ $author['email'] }}" required>
    </div>

    <div>
        <label>Password (Leave blank if not changing)</label>
        <input type="password" name="password">
    </div>

    <button type="submit" class="btn btn-success">Update Author</button>
</form>