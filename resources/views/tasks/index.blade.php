@extends('layouts.app')
@section('title', 'Tugas')

@section('content')
<div class="page-head">
    <h1>Tugas</h1>
    <p>Cari, saring, dan tandai tugas yang sudah selesai</p>
    <a class="btn btn-sm" href="{{ route('tasks.create') }}">+ Tambah Tugas</a>
</div>

<form class="filters" method="GET" action="{{ route('tasks.index') }}">
    <div>
        <label for="q">Cari judul</label>
        <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="mis. ERD">
    </div>
    <div>
        <label for="f_course">Mata kuliah</label>
        <select id="f_course" name="course_id">
            <option value="">Semua</option>
            @foreach ($courses as $c)
                <option value="{{ $c->id }}" @selected(request('course_id') == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="f_status">Status</label>
        <select id="f_status" name="status">
            <option value="">Semua</option>
            <option value="pending" @selected(request('status') === 'pending')>Belum selesai</option>
            <option value="done" @selected(request('status') === 'done')>Selesai</option>
        </select>
    </div>
    <div>
        <button class="btn btn-green" type="submit">Terapkan</button>
    </div>
</form>

<div class="list">
@forelse ($tasks as $task)
    <div class="row {{ $task->is_done ? 'done' : '' }}">
        <form class="inline" method="POST" action="{{ route('tasks.toggle', $task) }}">
            @csrf @method('PATCH')
            <button class="check {{ $task->is_done ? 'on' : '' }}" type="submit" title="Tandai selesai / belum"></button>
        </form>

        <div class="row-main">
            <div class="row-title">{{ $task->title }}</div>
            <div class="row-meta">
                <span class="badge b-course">{{ $task->course->name }}</span>
                <span class="sep">·</span> {{ $task->deadline->translatedFormat('d M Y') }}
                @if ($task->is_overdue) <span class="badge b-late">Terlambat</span> @endif
            </div>
        </div>

        <span class="badge b-{{ $task->priority }}">{{ ['low' => 'Rendah', 'medium' => 'Sedang', 'high' => 'Tinggi'][$task->priority] }}</span>

        <div class="row-actions">
            <a class="btn btn-sm btn-green" href="{{ route('tasks.edit', $task) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Hapus tugas ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">Tidak ada tugas yang cocok.</div>
@endforelse
</div>
@endsection
