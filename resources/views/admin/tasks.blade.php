@extends('layouts.app')

@section('content')
<div class="admin-page">
    @if(session('success'))
        <div style="margin-bottom: 20px; padding: 12px 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
        </div>
    @endif

    <div class="admin-card table-card">
        <div class="card-header">
            <i data-lucide="database" size="20" class="card-header-icon"></i>
            <h3>Master Task List</h3>
            <span class="badge-count">{{ count($tasks) }} Total</span>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Task Details</th>
                        <th>Assigned To</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #111827;">{{ $task->title }}</div>
                                <div class="desc-cell" title="{{ $task->description }}">{{ $task->description }}</div>
                            </td>
                            <td>
                                @if($task->assignee)
                                    <span class="designation-pill" style="background: #f0fdf4; color: #166534;">👤 {{ $task->assignee->name }}</span>
                                @elseif($task->team)
                                    <span class="designation-pill" style="background: #fdf2f8; color: #9d174d;">👥 {{ $task->team->name }}</span>
                                @else
                                    <span style="color: #9ca3af;">Unassigned</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                <i data-lucide="calendar" size="12"></i> {{ $task->due_date->format('d M Y') }}
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'Pending' => '#fef3c7',
                                        'In Progress' => '#eff6ff',
                                        'Completed' => '#ecfdf5'
                                    ];
                                    $textColors = [
                                        'Pending' => '#92400e',
                                        'In Progress' => '#1e40af',
                                        'Completed' => '#065f46'
                                    ];
                                @endphp
                                <span style="background: {{ $statusColors[$task->status] ?? '#f3f4f6' }}; color: {{ $textColors[$task->status] ?? '#374151' }}; padding: 4px 10px; border-radius: 99px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-edit" onclick="openEditTaskModal({{ $task->id }}, '{{ $task->title }}', '{{ $task->description }}', '{{ $task->assigned_to }}', '{{ $task->assigned_team }}', '{{ $task->due_date->format('Y-m-d') }}', '{{ $task->status }}')">
                                        <i data-lucide="edit-2" size="14"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i data-lucide="trash-2" size="14"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-row">No administrative tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div id="editTaskModal" class="project-modal-overlay" style="display: none;" onclick="closeEditTaskModal()">
    <div class="project-modal" onclick="event.stopPropagation()">
        <div class="project-modal-header">
            <h3><i data-lucide="clipboard-list" size="20"></i> Edit Administrative Task</h3>
            <button class="btn-cancel" onclick="closeEditTaskModal()"><i data-lucide="x" size="18"></i></button>
        </div>
        <form id="editTaskForm" action="" method="POST" class="admin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Task Title</label>
                <input type="text" name="title" id="edit_task_title" required>
            </div>
            <div class="form-group">
                <label>Task Description</label>
                <textarea name="description" id="edit_task_description"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Assign to Employee</label>
                    <select name="assigned_to" id="edit_task_assigned_to">
                        <option value="">— Select Employee —</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Assign to Team</label>
                    <select name="assigned_team" id="edit_task_assigned_team">
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
                    <input type="date" name="due_date" id="edit_task_due_date" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="edit_task_status" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 10px;">
                <i data-lucide="save" size="18"></i> Update Task Details
            </button>
        </form>
    </div>
</div>

<script>
    function openEditTaskModal(id, title, description, assignedTo, assignedTeam, dueDate, status) {
        const modal = document.getElementById('editTaskModal');
        const form = document.getElementById('editTaskForm');
        
        document.getElementById('edit_task_title').value = title;
        document.getElementById('edit_task_description').value = description;
        document.getElementById('edit_task_assigned_to').value = assignedTo || '';
        document.getElementById('edit_task_assigned_team').value = assignedTeam || '';
        document.getElementById('edit_task_due_date').value = dueDate;
        document.getElementById('edit_task_status').value = status;
        
        form.action = `/admin/tasks/${id}`;
        modal.style.display = 'flex';
    }

    function closeEditTaskModal() {
        document.getElementById('editTaskModal').style.display = 'none';
    }
</script>
@endsection
