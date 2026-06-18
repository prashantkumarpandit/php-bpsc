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
            <i data-lucide="list" size="20" class="card-header-icon"></i>
            <h3>Active Teams</h3>
            <span class="badge-count">{{ count($teams) }} Total</span>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Members</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                        <tr>
                            <td style="font-weight: 600; color: #111827;">{{ $team->name }}</td>
                            <td>
                                <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                    @foreach($team->members as $member)
                                        <span style="background: #f1f5f9; padding: 2px 8px; border-radius: 4px; font-size: 12px; color: #475569;">{{ $member->name }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $team->creator->name ?? 'System' }}</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-edit" onclick="openEditTeamModal({{ $team->id }}, '{{ $team->name }}', '{{ $team->description }}', {{ $team->members->pluck('id') }})">
                                        <i data-lucide="edit-2" size="14"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Disband this team?')">
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
                            <td colspan="4" class="empty-row">No teams formed yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Team Modal -->
<div id="editTeamModal" class="project-modal-overlay" style="display: none;" onclick="closeEditTeamModal()">
    <div class="project-modal" onclick="event.stopPropagation()">
        <div class="project-modal-header">
            <h3><i data-lucide="users" size="20"></i> Edit Departmental Team</h3>
            <button class="btn-cancel" onclick="closeEditTeamModal()"><i data-lucide="x" size="18"></i></button>
        </div>
        <form id="editTeamForm" action="" method="POST" class="admin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="name" id="edit_team_name" required>
            </div>
            <div class="form-group">
                <label>Team Description</label>
                <textarea name="description" id="edit_team_description"></textarea>
            </div>
            <div class="form-group">
                <label>Update Team Members</label>
                <select name="members[]" id="edit_team_members" multiple style="height: 150px;" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->designation }})</option>
                    @endforeach
                </select>
                <small style="color: #64748b; margin-top: 4px;">Hold Ctrl (Windows) or Command (Mac) to select multiple employees.</small>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 10px;">
                <i data-lucide="save" size="18"></i> Update Team Formation
            </button>
        </form>
    </div>
</div>

<script>
    function openEditTeamModal(id, name, description, members) {
        const modal = document.getElementById('editTeamModal');
        const form = document.getElementById('editTeamForm');
        const select = document.getElementById('edit_team_members');
        
        document.getElementById('edit_team_name').value = name;
        document.getElementById('edit_team_description').value = description;
        
        // Clear previous selections
        Array.from(select.options).forEach(option => option.selected = false);
        
        // Select current members
        members.forEach(memberId => {
            const option = select.querySelector(`option[value="${memberId}"]`);
            if (option) option.selected = true;
        });
        
        form.action = `/admin/teams/${id}`;
        modal.style.display = 'flex';
    }

    function closeEditTeamModal() {
        document.getElementById('editTeamModal').style.display = 'none';
    }
</script>
@endsection
