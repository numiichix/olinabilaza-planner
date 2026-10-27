@extends('layouts.app')
@section('title', 'Catatan')

@section('content')
<div class="page-head">
    <h1>Catatan</h1>
    <p>Simpan ringkasan materi kuliahmu di sini</p>
    <a class="btn btn-sm" href="{{ route('notes.create') }}">+ Tambah Catatan</a>
</div>

<form class="filters filters-note" method="GET" action="{{ route('notes.index') }}">
    <div>
        <label for="q">Cari catatan</label>
        <input id="q" type="text" name="q" value="{{ request('q') }}" placeholder="judul atau isi catatan">
    </div>
    <div><button class="btn btn-green" type="submit">Cari</button></div>
</form>

<div class="grid list">
    @forelse ($notes as $note)
        <div class="card">
            <h3>{{ $note->title }}</h3>
            @if ($note->course) <span class="badge b-course">{{ $note->course->name }}</span> @endif
            <p class="note-body">{{ \Illuminate\Support\Str::limit($note->content, 160) }}</p>
            <div class="row-actions">
                <a class="btn btn-sm btn-green" href="{{ route('notes.edit', $note) }}">Edit</a>
                <form class="inline" method="POST" action="{{ route('notes.destroy', $note) }}" onsubmit="return confirm('Hapus catatan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty empty-wide">Belum ada catatan.</div>
    @endforelse
</div>
@endsection
