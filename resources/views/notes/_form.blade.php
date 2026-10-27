@csrf
<label for="course_id">Course (optional)</label>
<select id="course_id" name="course_id">
    <option value="">— no course —</option>
    @foreach ($courses as $c)
        <option value="{{ $c->id }}" @selected(old('course_id', $note->course_id ?? '') == $c->id)>{{ $c->name }}</option>
    @endforeach
</select>

<label for="title">Note title</label>
<input id="title" type="text" name="title" value="{{ old('title', $note->title ?? '') }}" required>

<label for="content">Note content</label>
<textarea id="content" name="content" rows="7" required>{{ old('content', $note->content ?? '') }}</textarea>

<div class="form-actions">
    <button class="btn" type="submit">Save</button>
    <a class="btn btn-outline" href="{{ route('notes.index') }}">Cancel</a>
</div>
