@csrf
<label for="course_id">Course</label>
<select id="course_id" name="course_id" required>
    <option value="">— select a course —</option>
    @foreach ($courses as $c)
        <option value="{{ $c->id }}" @selected(old('course_id', $task->course_id ?? '') == $c->id)>{{ $c->name }}</option>
    @endforeach
</select>

<label for="title">Task title</label>
<input id="title" type="text" name="title" value="{{ old('title', $task->title ?? '') }}" required>

<label for="description">Description (optional)</label>
<textarea id="description" name="description" rows="3">{{ old('description', $task->description ?? '') }}</textarea>

<label for="deadline">Deadline</label>
<input id="deadline" type="date" name="deadline" value="{{ old('deadline', isset($task) ? $task->deadline->format('Y-m-d') : '') }}" required>

<label for="priority">Priority</label>
<select id="priority" name="priority" required>
    @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $val => $label)
        <option value="{{ $val }}" @selected(old('priority', $task->priority ?? 'medium') == $val)>{{ $label }}</option>
    @endforeach
</select>

<div class="form-actions">
    <button class="btn" type="submit">Save</button>
    <a class="btn btn-outline" href="{{ route('tasks.index') }}">Cancel</a>
</div>
