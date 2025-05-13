@extends('layouts.admin')

@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>

<div class="card shadow-sm mx-3 mb-3">
    <div class="card-body">

        {{-- Notifikasi Error --}}
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Edit Author --}}
        <form action="{{ route('admin.author.update', ['id' => $author['id']]) }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $author['id'] }}">

            {{-- Nama --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{ $author['name'] }}" placeholder="Nama Author" required>
                <label for="name">Nama Author</label>
            </div>

            {{-- Email --}}
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="{{ $author['email'] }}" placeholder="Email" required>
                <label for="email">Email</label>
            </div>

            {{-- Password --}}
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                <label for="password">Password (kosongkan jika tidak diubah)</label>
            </div>

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Author</button>
            </div>
        </form>

    </div>
</div>
@endsection
