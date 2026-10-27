@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')

@section('content')
<h1 class="page-title-center">Tambah Mata Kuliah</h1>
<div class="form-card">
    <form method="POST" action="{{ route('courses.store') }}">
        @include('courses._form')
    </form>
</div>
@endsection
