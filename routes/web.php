<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/history', [PublicController::class, 'history'])->name('history');
Route::get('/contact-us', [PublicController::class, 'contactUs'])->name('contact-us');
Route::get('/the-commission', [PublicController::class, 'theCommission'])->name('the-commission');
Route::get('/exam-calendar', [PublicController::class, 'examCalendar'])->name('exam-calendar');
Route::get('/syllabus', [PublicController::class, 'syllabus'])->name('syllabus');
Route::get('/advertisements', [PublicController::class, 'advertisements'])->name('advertisements');
Route::get('/online-application', [PublicController::class, 'onlineApplication'])->name('online-application');
Route::get('/constitutional-provisions', [PublicController::class, 'constitutionalProvisions'])->name('constitutional-provisions');
Route::get('/faqs', [PublicController::class, 'faqs'])->name('faqs');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/archives', [PublicController::class, 'archives'])->name('archives');
Route::get('/community', [PublicController::class, 'community'])->name('community');
Route::get('/section', [PublicController::class, 'section'])->name('section');
Route::get('/asset-declaration', [PublicController::class, 'assetDeclaration'])->name('asset-declaration');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Admin Profile
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Employees
    Route::get('/admin/employees/create', [AdminController::class, 'createEmployee'])->name('admin.employees.create');
    Route::get('/admin/employees', [AdminController::class, 'employees'])->name('admin.employees');
    Route::post('/admin/employees', [AdminController::class, 'storeEmployee']);
    Route::put('/admin/employees/{user}', [AdminController::class, 'updateEmployee'])->name('admin.employees.update');
    Route::delete('/admin/employees/{user}', [AdminController::class, 'destroyEmployee'])->name('admin.employees.destroy');

    // Teams
    Route::get('/admin/teams/create', [AdminController::class, 'createTeam'])->name('admin.teams.create');
    Route::get('/admin/teams', [AdminController::class, 'teams'])->name('admin.teams');
    Route::post('/admin/teams', [AdminController::class, 'storeTeam']);
    Route::put('/admin/teams/{team}', [AdminController::class, 'updateTeam'])->name('admin.teams.update');
    Route::delete('/admin/teams/{team}', [AdminController::class, 'destroyTeam'])->name('admin.teams.destroy');

    // Tasks
    Route::get('/admin/tasks/create', [AdminController::class, 'createTask'])->name('admin.tasks.create');
    Route::get('/admin/tasks', [AdminController::class, 'tasks'])->name('admin.tasks');
    Route::post('/admin/tasks', [AdminController::class, 'storeTask']);
    Route::put('/admin/tasks/{task}', [AdminController::class, 'updateTask'])->name('admin.tasks.update');
    Route::delete('/admin/tasks/{task}', [AdminController::class, 'destroyTask'])->name('admin.tasks.destroy');

    // Projects
    Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects');
    Route::post('/admin/projects', [AdminController::class, 'storeProject']);
    Route::put('/admin/projects/{project}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/admin/projects/{project}', [AdminController::class, 'destroyProject'])->name('admin.projects.destroy');
});

// Employee Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-tasks', [EmployeeController::class, 'myTasks'])->name('employee.tasks');
    Route::put('/dashboard/tasks/{task}/status', [EmployeeController::class, 'updateTaskStatus']);
});
