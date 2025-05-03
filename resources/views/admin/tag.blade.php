@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('admin.tag.create')}}">
        @csrf
        <div style="margin-bottom: 10px;">
            <label for="nama">Nama:</label><br>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div>
            <button type="submit" class="btn btn-success">Tambah Tag</button>
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
                <th scope="col">Tag</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tagData as $tag)
            <tr>
                <th scope="row">{{ $tag['id'] }}</th>

                <!-- Input Form -->
                <td>
                    <form action="{{ route('admin.tag.edit', ['id' => $tag['id']]) }}" method="POST">
                        @csrf
                        <input type="text" name="nama" class="form-control" value="{{ $tag->nama }}">
                </td>

                <!-- Tombol Submit -->
                <td>
                        <button type="submit" class="btn btn-warning w-100">Edit</button>
                    </form>
                </td>

                <!-- Tombol Hapus -->
                <td>
                    <form action="{{ route('admin.tag.delete', ['id' => $tag['id']]) }}" method="POST">
                        @csrf
                        <button class="w-100 btn btn-danger" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection