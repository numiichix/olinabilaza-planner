@extends('layouts.app')
@section('title', 'Add Task')

@section('content')
<h1 class="page-title-center">Add Task</h1>

@if ($courses->isEmpty())
    <div class="empty">You don't have any courses yet. <a href="{{ route('courses.create') }}">Add a course first</a>.</div>
@else
    <div class="form-card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @include('tasks._form')
        </form>
    </div>
@endif
@endsection
