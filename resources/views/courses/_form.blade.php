@csrf
<label for="code">Kode mata kuliah</label>
<input id="code" type="text" name="code" value="{{ old('code', $course->code ?? '') }}" required>

<label for="name">Nama mata kuliah</label>
<input id="name" type="text" name="name" value="{{ old('name', $course->name ?? '') }}" required>

<label for="lecturer">Dosen (opsional)</label>
<input id="lecturer" type="text" name="lecturer" value="{{ old('lecturer', $course->lecturer ?? '') }}">

<label for="credits">SKS</label>
<input id="credits" type="number" min="1" max="6" name="credits" value="{{ old('credits', $course->credits ?? 3) }}" required>

<label for="day">Hari kuliah</label>
<select id="day" name="day" required>
    <option value="">Pilih hari</option>
    @foreach (\App\Models\Course::DAYS as $num => $dayName)
        <option value="{{ $num }}" @selected(old('day', $course->day ?? '') == $num)>{{ $dayName }}</option>
    @endforeach
</select>

<div class="field-row">
    <div>
        <label for="start_time">Jam mulai</label>
        <input id="start_time" type="time" name="start_time" value="{{ old('start_time', isset($course) ? substr($course->start_time, 0, 5) : '') }}" required>
    </div>
    <div>
        <label for="end_time">Jam selesai</label>
        <input id="end_time" type="time" name="end_time" value="{{ old('end_time', isset($course) ? substr($course->end_time, 0, 5) : '') }}" required>
    </div>
</div>

<div class="form-actions">
    <button class="btn" type="submit">Simpan</button>
    <a class="btn btn-outline" href="{{ route('courses.index') }}">Batal</a>
</div>
