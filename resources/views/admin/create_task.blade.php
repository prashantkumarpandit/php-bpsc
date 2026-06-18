@extends('layouts.app')

@section('content')
<div class="admin-page">
    <div class="admin-card">
        <div class="card-header">
            <i data-lucide="clipboard-list" size="20" class="card-header-icon"></i>
            <h3>Assign New Administrative Task</h3>
        </div>

        @if(session('success'))
            <div style="margin: 20px 24px; padding: 12px 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.tasks') }}" method="POST" class="admin-form">
            @csrf
            <div class="form-group">
                <label>Task Title</label>
                <input type="text" name="title" placeholder="Enter task title" required>
            </div>
            <div class="form-group">
                <label>Task Description</label>
                <textarea name="description" placeholder="Provide detailed instructions for this task..."></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Assign to Employee (Individual)</label>
                    <select name="assigned_to">
                        <option value="">— Select Employee —</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Assign to Team (Collective)</label>
                    <select name="assigned_team">
                        <option value="">— Select Team —</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" required>
                </div>
                <div class="form-group" style="justify-content: flex-end; padding-bottom: 5px;">
                    <button type="submit" class="btn-submit" style="width: 100%;">
                        <i data-lucide="send" size="18"></i> Assign Task
                    </button>
                </div>
            </div>
            <small style="color: #64748b;">Note: You must assign the task to at least one individual or a team.</small>
        </form>
    </div>
</div>
@endsection
