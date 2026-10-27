@extends('layouts.app')
@section('title', 'Tasks')

@section('content')
<div class="page-head">
    <h1>Tasks</h1>
    <p>Search, filter, and mark your tasks as done</p>
    <a class="btn btn-sm" href="{{ route('tasks.create') }}">+ Add Task</a>
</div>

<form class="filters" method="GET" action="{{ route('tasks.index') }}">
    <div>
        <label for="q">Search title</label>
        <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="e.g. ERD">
    </div>
    <div>
        <label for="f_course">Course</label>
        <select id="f_course" name="course_id">
            <option value="">All</option>
            @foreach ($courses as $c)
                <option value="{{ $c->id }}" @selected(request('course_id') == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="f_status">Status</label>
        <select id="f_status" name="status">
            <option value="">All</option>
            <option value="pending" @selected(request('status') === 'pending')>Not done</option>
            <option value="done" @selected(request('status') === 'done')>Done</option>
        </select>
    </div>
    <div>
        <button class="btn btn-green" type="submit">Apply</button>
    </div>
</form>

<div class="list">
@forelse ($tasks as $task)
    <div class="row {{ $task->is_done ? 'done' : '' }}">
        <form class="inline" method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf @method('PATCH')
            <button class="check {{ $task->is_done ? 'on' : '' }}" type="submit" title="Mark as done / not done"></button>
        </form>

        <div class="row-main">
            <div class="row-title">{{ $task->title }}</div>
            <div class="row-meta">
                <span class="badge b-course">{{ $task->course->name }}</span>
                <span class="sep">·</span> {{ $task->deadline->translatedFormat('d M Y') }}
                @if ($task->is_overdue) <span class="badge b-late">Overdue</span> @endif
            </div>
        </div>

        <span class="badge b-{{ $task->priority }}">{{ ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'][$task->priority] }}</span>

        <div class="row-actions">
            <a class="btn btn-sm btn-green" href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">No matching tasks.</div>
@endforelse
</div>
@endsection
