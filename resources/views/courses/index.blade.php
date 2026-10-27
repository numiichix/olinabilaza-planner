@extends('layouts.app')
@section('title', 'Mata Kuliah')

@section('content')
<div class="page-head">
    <h1>Mata Kuliah</h1>
    <p>Daftar mata kuliah yang diambil</p>
    <a class="btn btn-sm" href="{{ route('courses.create') }}">+ Tambah Mata Kuliah</a>
</div>

<div class="list">
@forelse ($courses as $course)
    <div class="row">
        <div class="row-main">
            <div class="row-title">{{ $course->name }} <span class="badge b-course">{{ $course->code }}</span></div>
            <div class="row-meta">
                {{ $course->lecturer ?: 'Dosen belum diisi' }} <span class="sep">·</span> {{ $course->credits }} SKS <span class="sep">·</span>
                {{ $course->tasks_count }} tugas <span class="sep">·</span> {{ $course->notes_count }} catatan
            </div>
        </div>
        <div class="row-schedule">
            Setiap {{ $course->day_name }}
            <b>{{ $course->time_range }}</b>
        </div>
        <div class="row-actions">
            <a class="btn btn-sm btn-green" href="{{ route('courses.edit', $course) }}">Edit</a>
            <form class="inline" method="POST" action="{{ route('courses.destroy', $course) }}"
                  onsubmit="return confirm('Hapus mata kuliah ini? Semua tugas di dalamnya juga akan terhapus.')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
            </form>
        </div>
    </div>
@empty
    <div class="empty">Belum ada mata kuliah. Tambahkan yang pertama dulu ya.</div>
@endforelse
</div>
@endsection
