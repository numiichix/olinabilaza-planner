@extends('layouts.app')
@section('title', 'Tambah Catatan')

@section('content')
<h1 class="page-title-center">Tambah Catatan</h1>
<div class="form-card">
    <form method="POST" action="{{ route('notes.store') }}">
        @include('notes._form')
    </form>
</div>
@endsection
