<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    private function own(Task $task): void
    {
        abort_unless($task->user_id === auth()->id(), 403);
    }

    private function rules(): array
    {
        return [
            // course_id must exist AND belong to the logged-in user
            'course_id' => ['required', Rule::exists('courses', 'id')->where('user_id', auth()->id())],
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:2000',
            'deadline' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ];
    }

    public function index(Request $request)
    {
        $query = $request->user()->tasks()->with('course');

        // Feature: search
        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->q.'%');
        }
        // Feature: course filter
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        // Feature: status filter
        if ($request->status === 'done') {
            $query->where('is_done', true);
        } elseif ($request->status === 'pending') {
            $query->where('is_done', false);
        }

        $tasks = $query->orderBy('is_done')->orderBy('deadline')->get();
        $courses = $request->user()->courses()->orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'courses'));
    }

    public function create(Request $request)
    {
        $courses = $request->user()->courses()->orderBy('name')->get();

        return view('tasks.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $request->user()->tasks()->create($data);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    public function edit(Request $request, Task $task)
    {
        $this->own($task);
        $courses = $request->user()->courses()->orderBy('name')->get();

        return view('tasks.edit', compact('task', 'courses'));
    }

    public function update(Request $request, Task $task)
    {
        $this->own($task);
        $task->update($request->validate($this->rules()));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function toggle(Task $task)
    {
        $this->own($task);
        $task->update(['is_done' => ! $task->is_done]);

        return back()->with('success', $task->is_done ? 'Task marked as done.' : 'Task marked as not done.');
    }

    public function destroy(Task $task)
    {
        $this->own($task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }
}
