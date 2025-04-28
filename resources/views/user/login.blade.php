<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>
<h1>{{ $title }}</h1>
@if(isset($error))
    <div class="row">
        <div class="alert alert-danger" role="alert">
            {{$error}}
        </div>
    </div>
@endif

<form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/doLogin">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="form-floating mb-3">
    <input name="user" type="text" class="form-control" id="user" placeholder="id">
    <label for="user">User</label>
</div>

<div class="form-floating mb-3">
    <input name="password" type="password" class="form-control" id="password" placeholder="password">
    <label for="password">Password</label>
</div>
<div>
    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="admin">Admin</option>
        <option value="author">Author</option>
    </select>
</div>
<button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
</form>
</body>