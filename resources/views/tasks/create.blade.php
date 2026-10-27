@extends('layouts.app')
@section('title', 'Tambah Tugas')

@section('content')
<h1 class="page-title-center">Tambah Tugas</h1>

@if ($courses->isEmpty())
    <div class="empty">Kamu belum punya mata kuliah. <a href="{{ route('courses.create') }}">Tambah mata kuliah dulu</a>.</div>
@else
    <div class="form-card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @include('tasks._form')
        </form>
    </div>
@endif
@endsection
