<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Team;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $teamIds = $user->teams()->pluck('teams.id')->toArray();

        $allTasksQuery = Task::where(function($query) use ($user, $teamIds) {
            $query->where('assigned_to', $user->id)
                  ->orWhereIn('assigned_team', $teamIds);
        });

        $totalTasks = (clone $allTasksQuery)->count();
        $completedTasks = (clone $allTasksQuery)->where('status', 'Completed')->count();
        $inProgressTasks = (clone $allTasksQuery)->where('status', 'In Progress')->count();
        $pendingTasks = (clone $allTasksQuery)->where('status', 'Pending')->count();
        $activeTasks = $pendingTasks + $inProgressTasks;

        $stats = [
            'totalTasks' => $totalTasks,
            'activeTasks' => $activeTasks,
            'completedTasks' => $completedTasks,
        ];

        $chartData = [
            'Completed' => $completedTasks,
            'In Progress' => $inProgressTasks,
            'Pending' => $pendingTasks,
        ];

        return view('employee.dashboard', compact('stats', 'chartData'));
    }

    public function myTasks()
    {
        $user = auth()->user();
        $teamIds = $user->teams()->pluck('teams.id')->toArray();

        $tasks = Task::with('team')
            ->where(function($query) use ($user, $teamIds) {
                $query->where('assigned_to', $user->id)
                      ->orWhereIn('assigned_team', $teamIds);
            })
            ->orderBy('due_date', 'asc')
            ->get();

        return view('employee.tasks', compact('tasks'));
    }

    public function updateTaskStatus(Request $request, Task $task)
    {
        $user = auth()->user();
        $teamIds = $user->teams()->pluck('teams.id')->toArray();

        // Check if task is assigned to user or their team
        if ($task->assigned_to !== $user->id && !in_array($task->assigned_team, $teamIds)) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Task status updated');
    }
}
