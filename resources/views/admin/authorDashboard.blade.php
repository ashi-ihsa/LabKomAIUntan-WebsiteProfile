@extends('layouts.admin')

@section('content')
<form method="POST" action="/admin/author/create">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="name">Nama:</label><br>
            <input type="text" name="name" id="name" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Tambah Author</button>
        </div>
</form>

<div class="row align-items-right g-lg-5 py-5">
    <div class="mx-auto">
        <form id="deleteForm" method="post" style="display: none">
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($authorData as $author)
                <tr>
                    <th scope="row">{{$author['id']}}</th>
                    <td>{{$author['name']}}</td>
                    <td>
                        <form action="/admin/author/{{$author['id']}}/delete" method="post">
                            @csrf
                            <button class="w-100 btn btn-lg btn-danger" type="submit">Remove</button>
                        </form>
                    </td>
                    <td>
                    <form action="/admin/author/{{ $author['id'] }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">Edit</button>
                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection