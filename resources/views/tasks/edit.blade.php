@extends('layouts.app')
@section('title', 'Edit Tugas')

@section('content')
<h1 class="page-title-center">Edit Tugas</h1>
<div class="form-card">
    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @method('PUT')
        @include('tasks._form')
    </form>
</div>
@endsection
