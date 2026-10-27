<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalTasks = $user->tasks()->count();
        $doneTasks = $user->tasks()->where('is_done', true)->count();

        return view('dashboard', [
            'courseCount' => $user->courses()->count(),
            'noteCount' => $user->notes()->count(),
            'pendingCount' => $totalTasks - $doneTasks,
            'doneCount' => $doneTasks,
            'progress' => $totalTasks > 0 ? round($doneTasks / $totalTasks * 100) : 0,
            'upcoming' => $user->tasks()->with('course')
                ->where('is_done', false)
                ->orderBy('deadline')
                ->take(5)
                ->get(),
        ]);
    }
}
