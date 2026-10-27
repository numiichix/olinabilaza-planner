@extends('layouts.app')
@section('title', 'Courses')

@section('content')
<div class="page-head">
    <h1>Courses</h1>
    <p>List of enrolled courses</p>
    <a class="btn btn-sm" href="{{ route('courses.create') }}">+ Add Course</a>
</div>

<div class="list">
@forelse ($courses as $course)
    <div class="row">
        <div class="row-main">
            <div class="row-title">{{ $course->name }} <span class="badge b-course">{{ $course->code }}</span></div>
            <div class="row-meta">
                {{ $course->lecturer ?: 'Lecturer not set' }} <span class="sep">·</span> {{ $course->credits }} credits <span class="sep">·</span>
                {{ $course->tasks_count }} tasks <span class="sep">·</span> {{ $course->notes_count }} notes
            </div>
        </div>
        <div class="row-schedule">
            Every {{ $course->day_name }}
            <b>{{ $course->time_range }}</b>
        </div>
        <div class="row-actions">
            <a class="btn btn-sm btn-green" href="{{ route('courses.edit', $course) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('courses.destroy', $course) }}"
                  onsubmit="return confirm('Delete this course? All its tasks will also be deleted.')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">No courses yet. Add your first one!</div>
@endforelse
</div>
@endsection
