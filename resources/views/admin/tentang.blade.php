@extends('layouts.admin')

@section('content')
<div class="container-tentang">
    <form method="post" action="{{ route('admin.tentang.save') }}">
        @csrf
        <textarea id="summernote" name="content">{!! $content !!}</textarea>
        <input type="submit" value="Update">
    </form>
</div>
@include('partials.summernote')
@endsection