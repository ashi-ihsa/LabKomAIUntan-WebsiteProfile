@extends('layouts.admin')

@section('content')
<h3 class="mx-3 mb-3 mt-3">{{ $title ?? 'Kelola Konten Tentang' }}</h3>
<div class="card shadow-sm mx-3 mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.tentang.save') }}">
            @csrf

            {{-- Summernote --}}
            <div class="mb-3">
                <label for="summernote" class="form-label">Konten Tentang</label>
                <textarea id="summernote" name="content" class="form-control" rows="10">{!! $content !!}</textarea>
            </div>

            {{-- Tombol Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@include('partials.summernote')
@endsection