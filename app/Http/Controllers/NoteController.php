<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    private function own(Note $note): void
    {
        abort_unless($note->user_id === auth()->id(), 403);
    }

    private function rules(): array
    {
        return [
            'course_id' => ['nullable', Rule::exists('courses', 'id')->where('user_id', auth()->id())],
            'title' => 'required|string|max:150',
            'content' => 'required|string|max:5000',
        ];
    }

    public function index(Request $request)
    {
        $query = $request->user()->notes()->with('course');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->q.'%')
                  ->orWhere('content', 'like', '%'.$request->q.'%');
            });
        }

        $notes = $query->latest()->get();

        return view('notes.index', compact('notes'));
    }

    public function create(Request $request)
    {
        $courses = $request->user()->courses()->orderBy('name')->get();

        return view('notes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $request->user()->notes()->create($data);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil disimpan.');
    }

    public function edit(Request $request, Note $note)
    {
        $this->own($note);
        $courses = $request->user()->courses()->orderBy('name')->get();

        return view('notes.edit', compact('note', 'courses'));
    }

    public function update(Request $request, Note $note)
    {
        $this->own($note);
        $note->update($request->validate($this->rules()));

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy(Note $note)
    {
        $this->own($note);
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Catatan dihapus.');
    }
}
