@extends('layouts.app')

@section('content')
<div class="admin-page">
    <div class="admin-card">
        <div class="card-header">
            <i data-lucide="folder-kanban" size="20" class="card-header-icon"></i>
            <h3>Create New Project</h3>
        </div>

        @if(session('success'))
            <div style="margin: 20px 24px; padding: 12px 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.projects') }}" method="POST" class="admin-form">
            @csrf
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" name="name" placeholder="Enter project name" required>
            </div>
            <div class="form-group">
                <label>Project Description</label>
                <textarea name="description" placeholder="Brief overview of the project objectives..."></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" required>
                </div>
            </div>
            <div class="form-group">
                <label>Assign to Team</label>
                <select name="assigned_team" required>
                    <option value="">— Select a Team —</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }} ({{ $team->members->count() }} members)</option>
                    @endforeach
                </select>
                <small style="color: #64748b; margin-top: 4px;">Employees are managed via Teams. Create a team first to assign them here.</small>
            </div>
            <button type="submit" class="btn-submit">
                <i data-lucide="plus" size="18"></i> Launch Project
            </button>
        </form>
    </div>

    <h3 class="bpsc-section-title" style="margin: 32px 0 20px; border-bottom: none;">Active Projects</h3>
    <div class="projects-grid">
        @forelse($projects as $project)
            <div class="proj-card {{ $project->due_date->isPast() ? 'proj-card-overdue' : '' }}">
                <div class="proj-card-top">
                    <div class="proj-card-title-row">
                        <i data-lucide="briefcase" size="18" class="proj-card-icon"></i>
                        <h4>{{ $project->name }}</h4>
                    </div>
                    <span class="proj-badge {{ $project->status == 'Active' ? 'proj-badge-active' : 'proj-badge-completed' }}">
                        {{ $project->status }}
                    </span>
                </div>
                <p class="proj-card-desc">{{ $project->description }}</p>
                <div class="proj-card-dates">
                    <div class="proj-date-item">
                        <i data-lucide="calendar" size="14"></i>
                        <span>Start: {{ $project->start_date->format('d M Y') }}</span>
                    </div>
                    <div class="proj-date-item">
                        <i data-lucide="clock" size="14"></i>
                        <span>Due: {{ $project->due_date->format('d M Y') }}</span>
                    </div>
                </div>
                <div style="font-size: 13px; color: #1e40af; background: #eff6ff; padding: 8px 12px; border-radius: 8px; margin-top: 5px;">
                    <i data-lucide="users" size="14" style="margin-right: 6px; vertical-align: middle;"></i>
                    <strong>Team:</strong> {{ $project->team->name ?? 'Unassigned' }}
                </div>
                <div class="proj-card-actions">
                    <button class="proj-btn proj-btn-edit" onclick="openEditProjectModal({{ $project->id }}, '{{ $project->name }}', '{{ $project->description }}', '{{ $project->start_date->format('Y-m-d') }}', '{{ $project->due_date->format('Y-m-d') }}', '{{ $project->assigned_team }}', '{{ $project->status }}')">
                        <i data-lucide="edit-2" size="14"></i> Edit
                    </button>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove this project?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="proj-btn proj-btn-delete">
                            <i data-lucide="trash-2" size="14"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="admin-card" style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #64748b;">
                <i data-lucide="folder-open" size="48" style="opacity: 0.2; margin-bottom: 12px;"></i>
                <p>No projects found. Launch your first project today!</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Edit Project Modal -->
<div id="editProjectModal" class="project-modal-overlay" style="display: none;" onclick="closeEditProjectModal()">
    <div class="project-modal" onclick="event.stopPropagation()">
        <div class="project-modal-header">
            <h3><i data-lucide="folder-kanban" size="20"></i> Edit Project Details</h3>
            <button class="btn-cancel" onclick="closeEditProjectModal()"><i data-lucide="x" size="18"></i></button>
        </div>
        <form id="editProjectForm" action="" method="POST" class="admin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" name="name" id="edit_project_name" required>
            </div>
            <div class="form-group">
                <label>Project Description</label>
                <textarea name="description" id="edit_project_description"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" id="edit_project_start_date" required>
                </div>
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" id="edit_project_due_date" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Assign to Team</label>
                    <select name="assigned_team" id="edit_project_assigned_team" required>
                        <option value="">— Select a Team —</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="edit_project_status" required>
                        <option value="Active">Active</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 10px;">
                <i data-lucide="save" size="18"></i> Update Project Status
            </button>
        </form>
    </div>
</div>

<script>
    function openEditProjectModal(id, name, description, startDate, dueDate, assignedTeam, status) {
        const modal = document.getElementById('editProjectModal');
        const form = document.getElementById('editProjectForm');
        
        document.getElementById('edit_project_name').value = name;
        document.getElementById('edit_project_description').value = description;
        document.getElementById('edit_project_start_date').value = startDate;
        document.getElementById('edit_project_due_date').value = dueDate;
        document.getElementById('edit_project_assigned_team').value = assignedTeam;
        document.getElementById('edit_project_status').value = status;
        
        form.action = `/admin/projects/${id}`;
        modal.style.display = 'flex';
    }

    function closeEditProjectModal() {
        document.getElementById('editProjectModal').style.display = 'none';
    }
</script>
@endsection
