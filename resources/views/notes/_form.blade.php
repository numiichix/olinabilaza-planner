@csrf
<label for="course_id">Mata kuliah (opsional)</label>
<select id="course_id" name="course_id">
    <option value="">— tanpa mata kuliah —</option>
    @foreach ($courses as $c)
        <option value="{{ $c->id }}" @selected(old('course_id', $note->course_id ?? '') == $c->id)>{{ $c->name }}</option>
    @endforeach
</select>

<label for="title">Judul catatan</label>
<input id="title" type="text" name="title" value="{{ old('title', $note->title ?? '') }}" required>

<label for="content">Isi catatan</label>
<textarea id="content" name="content" rows="7" required>{{ old('content', $note->content ?? '') }}</textarea>

<div class="form-actions">
    <button class="btn" type="submit">Simpan</button>
    <a class="btn btn-outline" href="{{ route('notes.index') }}">Batal</a>
</div>
