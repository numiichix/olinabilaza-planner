@extends('layouts.app')
@section('title', 'Edit Task')

@section('content')
<h1 class="page-title-center">Edit Task</h1>
<div class="form-card">
    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @method('PUT')
        @include('tasks._form')
    </form>
</div>
@endsection
