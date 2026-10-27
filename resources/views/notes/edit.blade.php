@extends('layouts.app')
@section('title', 'Edit Catatan')

@section('content')
<h1 class="page-title-center">Edit Catatan</h1>
<div class="form-card">
    <form method="POST" action="{{ route('notes.update', $note) }}">
        @method('PUT')
        @include('notes._form')
    </form>
</div>
@endsection
