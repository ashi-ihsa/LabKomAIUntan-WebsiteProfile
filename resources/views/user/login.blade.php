<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 400px;
            margin: 5% auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">{{ $title }}</h1>

        @if(isset($error))
            <div class="alert alert-danger text-center" role="alert">
                {{ $error }}
            </div>
        @endif

        <div class="form-container">
            <form method="post" action="{{ route('doLogin') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-floating mb-3">
                    <input name="user" type="text" class="form-control" id="user" placeholder="id" required>
                    <label for="user">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select name="role" id="role" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="author">Author</option>
                    </select>
                </div>

                <button class="w-100 btn btn-primary btn-lg" type="submit">Sign In</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
