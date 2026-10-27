<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private function own(Course $course): void
    {
        abort_unless($course->user_id === auth()->id(), 403);
    }

    private function rules(): array
    {
        return [
            'code' => 'required|string|max:20',
            'name' => 'required|string|max:120',
            'lecturer' => 'nullable|string|max:120',
            'credits' => 'required|integer|min:1|max:6',
            'day' => 'required|integer|between:1,7',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }

    public function index(Request $request)
    {
        $courses = $request->user()->courses()
            ->withCount(['tasks', 'notes'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $request->user()->courses()->create($data);

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        $this->own($course);

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->own($course);
        $course->update($request->validate($this->rules()));

        return redirect()->route('courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $this->own($course);
        $course->delete(); // tugas terkait ikut terhapus (cascade), catatan jadi tanpa mata kuliah

        return redirect()->route('courses.index')->with('success', 'Mata kuliah dihapus.');
    }
}
