<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'Completed')->count();
        $pendingTasks = Task::where('status', 'Pending')->count();
        $inProgressTasks = Task::where('status', 'In Progress')->count();
        $activeTasks = $pendingTasks + $inProgressTasks;

        $stats = [
            'totalTasks' => $totalTasks,
            'activeTasks' => $activeTasks,
            'completedTasks' => $completedTasks,
            'employees' => User::where('role', 'Employee')->count(),
        ];

        // Chart Data: Tasks by status
        $chartData = [
            'Completed' => $completedTasks,
            'In Progress' => $inProgressTasks,
            'Pending' => $pendingTasks,
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    // Admin Profile
    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => [
                'nullable',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            // Delete old pic if exists
            if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
                Storage::disk('public')->delete($user->profile_pic);
            }
            $path = $request->file('profile_pic')->store('profiles', 'public');
            $user->profile_pic = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    // Employees
    public function createEmployee()
    {
        return view('admin.create_employee');
    }

    public function employees()
    {
        $employees = User::where('role', 'Employee')->latest()->get();
        return view('admin.employees', compact('employees'));
    }

    public function storeEmployee(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'designation' => 'required|string|max:255',
                'password' => [
                    'required',
                    'string',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ],
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'designation' => $request->designation,
                'password' => Hash::make($request->password),
                'role' => 'Employee',
            ]);

            return redirect()->route('admin.employees')->with('success', 'Employee account created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function updateEmployee(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'designation' => 'required|string|max:255',
            ]);

            $user->update($request->only('name', 'email', 'designation'));

            return redirect()->route('admin.employees')->with('success', 'Employee information updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroyEmployee(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.employees')->with('success', 'Employee account deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Teams
    public function createTeam()
    {
        $employees = User::where('role', 'Employee')->get();
        return view('admin.create_team', compact('employees'));
    }

    public function teams()
    {
        $teams = Team::with('members', 'creator')->latest()->get();
        $employees = User::where('role', 'Employee')->get();
        return view('admin.teams', compact('teams', 'employees'));
    }

    public function storeTeam(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'members' => 'required|array|min:1',
                'members.*' => 'exists:users,id',
            ]);

            $team = Team::create([
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => auth()->id(),
            ]);

            $team->members()->attach($request->members);

            return redirect()->route('admin.teams')->with('success', 'Team formed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function updateTeam(Request $request, Team $team)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'members' => 'required|array|min:1',
                'members.*' => 'exists:users,id',
            ]);

            $team->update($request->only('name', 'description'));
            $team->members()->sync($request->members);

            return redirect()->route('admin.teams')->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroyTeam(Team $team)
    {
        try {
            $team->delete();
            return redirect()->route('admin.teams')->with('success', 'Team disbanded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Tasks
    public function createTask()
    {
        $employees = User::where('role', 'Employee')->get();
        $teams = Team::all();
        return view('admin.create_task', compact('employees', 'teams'));
    }

    public function tasks()
    {
        $tasks = Task::with('assignee', 'team')->latest()->get();
        $employees = User::where('role', 'Employee')->get();
        $teams = Team::all();
        return view('admin.tasks', compact('tasks', 'employees', 'teams'));
    }

    public function storeTask(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
                'assigned_team' => 'nullable|exists:teams,id',
                'due_date' => 'required|date',
            ]);

            if (!$request->assigned_to && !$request->assigned_team) {
                return redirect()->back()->withErrors(['assignment' => 'Task must be assigned to either an individual or a team.'])->withInput();
            }

            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'assigned_to' => $request->assigned_to ?: null,
                'assigned_team' => $request->assigned_team ?: null,
                'due_date' => $request->due_date,
                'status' => 'Pending'
            ]);

            return redirect()->route('admin.tasks')->with('success', 'Administrative task assigned successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function updateTask(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
                'assigned_team' => 'nullable|exists:teams,id',
                'due_date' => 'required|date',
                'status' => 'required|string|in:Pending,In Progress,Completed',
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'assigned_to' => $request->assigned_to ?: null,
                'assigned_team' => $request->assigned_team ?: null,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.tasks')->with('success', 'Task updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroyTask(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('admin.tasks')->with('success', 'Task deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Projects
    public function projects()
    {
        $projects = Project::with('team')->latest()->get();
        $teams = Team::all();
        return view('admin.projects', compact('projects', 'teams'));
    }

    public function storeProject(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'required|date',
                'due_date' => 'required|date',
                'assigned_team' => 'required|exists:teams,id',
            ]);

            Project::create([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'assigned_team' => $request->assigned_team,
                'status' => 'Active'
            ]);

            return redirect()->route('admin.projects')->with('success', 'Project launched successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function updateProject(Request $request, Project $project)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_date' => 'required|date',
                'due_date' => 'required|date',
                'assigned_team' => 'required|exists:teams,id',
                'status' => 'required|string|in:Active,Completed',
            ]);

            $project->update($request->all());

            return redirect()->route('admin.projects')->with('success', 'Project details updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroyProject(Project $project)
    {
        try {
            $project->delete();
            return redirect()->route('admin.projects')->with('success', 'Project removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function allUsers()
    {
        $users = User::all();
        return response()->json($users);
    }
}
