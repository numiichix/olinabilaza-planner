@extends('layouts.app')
@section('title', 'Dashboard')
@section('bodyclass', 'grad')

@section('content')
<div class="hero hero-dash">
    <h1>Hello, {{ auth()->user()->name }}</h1>
    <a class="btn btn-yellow btn-lg" href="{{ route('tasks.create') }}">+ Add Task</a>
</div>

@php
    // [angka, label, kelas warna, kemiringan bintang (derajat)]
    $stats = [
        [$courseCount, 'Courses',        'star-pink',   -3],
        [$pendingCount, 'Tasks Left', 'star-yellow',  3],
        [$doneCount,    'Tasks Done', 'star-green',  -2],
        [$noteCount,    'Notes',          'star-blue',    3],
    ];
@endphp

<div class="stars">
    @foreach ($stats as [$num, $label, $color, $tilt])
        <div class="star {{ $color }}">
            <svg viewBox="0 0 180 150" aria-hidden="true" style="transform: rotate({{ $tilt }}deg)">
                <polygon points="90.0,10.0 121.6,44.7 169.9,59.7 141.1,96.2 139.4,140.2 90.0,128.1 40.6,140.2 38.9,96.2 10.1,59.7 58.4,44.7"
                         fill="currentColor" stroke="currentColor" stroke-width="20" stroke-linejoin="round"/>
            </svg>
            <div class="star-in">
                <span class="num">{{ $num }}</span>
                <span class="lbl">{{ $label }}</span>
            </div>
        </div>
    @endforeach
</div>

<div class="progress-card">
    <h3>Task Progress : {{ $progress }}%</h3>
    <div class="progress"><span style="width: {{ $progress }}%"></span></div>
</div>

<div class="panel-green">
    <h2>Deadlines</h2>
    @forelse ($upcoming as $task)
        <div class="row">
            <div class="row-main">
                <div class="row-title">{{ $task->title }}</div>
                <div class="row-meta">
                    {{ $task->course->name }} <span class="sep">·</span> {{ $task->deadline->translatedFormat('d M Y') }}
                    @if ($task->is_overdue) <span class="badge b-late">Overdue</span> @endif
                </div>
            </div>
            <span class="badge b-{{ $task->priority }}">{{ ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'][$task->priority] }}</span>
        </div>
    @empty
        <p class="empty-msg">Yay, no tasks yet</p>
    @endforelse
</div>
@endsection
