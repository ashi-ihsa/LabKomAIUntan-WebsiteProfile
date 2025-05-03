@extends('layouts.admin')

@section('content')
<form method="post" action="{{route('admin.tentang.save')}}">
    @csrf
    <textarea id="summernote" name="content">{!! $content !!}</textarea>
    <input type="submit" value="Update">
</form>
@include('partials.summernote')
@endsection