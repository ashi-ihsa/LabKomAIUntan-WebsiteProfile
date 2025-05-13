@extends('layouts.admin')

@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title }}</h3>

<div class="card shadow-sm mx-3">
    <h5 class="mx-3 mt-3">Tambah Author</h5>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.author.create') }}">
            @csrf

            {{-- Nama --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Author" required>
                <label for="name">Nama Author</label>
            </div>

            {{-- Email --}}
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>

            {{-- Password --}}
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            {{-- Tombol --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah Author</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm mx-3 my-3">
    <h5 class="mx-3 mt-3">Daftar Author</h5>

    {{-- Grid Author --}}
    <div class="row g-4 mx-1 mb-3">
        @foreach($authorData as $author)
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="row g-0">
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        {{-- Placeholder Foto (inisial nama) --}}
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 1.5rem;">
                            {{ strtoupper(substr($author['name'], 0, 1)) }}
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body d-flex flex-column justify-content-between h-100">
                            {{-- Nama dan Email --}}
                            <h6 class="card-title">{{ $author['name'] }}</h6>
                            <p class="text-muted" style="font-size: 0.9rem;">{{ $author['email'] }}</p>

                            {{-- Tombol Aksi --}}
                            <div class="mt-auto align-self-end">
                                <form action="{{ route('admin.author.edit', ['id' => $author['id']]) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary w-28">Edit</button>
                                </form>
                                <form action="{{ route('admin.author.delete', ['id' => $author['id']]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus author ini?');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger w-28">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
