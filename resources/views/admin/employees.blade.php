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
            <i data-lucide="users" size="20" class="card-header-icon"></i>
            <h3>All Employees</h3>
            <span class="badge-count">{{ count($employees) }} Total</span>
        </div>
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td style="font-weight: 600; color: #111827;">{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td><span class="designation-pill">{{ $employee->designation }}</span></td>
                            <td>{{ $employee->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn-edit" onclick="openEditModal({{ $employee->id }}, '{{ $employee->name }}', '{{ $employee->email }}', '{{ $employee->designation }}')">
                                        <i data-lucide="edit-2" size="14"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee account?')">
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
                            <td colspan="5" class="empty-row">No employees found. Create one above to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div id="editEmployeeModal" class="project-modal-overlay" style="display: none;" onclick="closeEditModal()">
    <div class="project-modal" onclick="event.stopPropagation()">
        <div class="project-modal-header">
            <h3><i data-lucide="user-plus" size="20"></i> Edit Employee Information</h3>
            <button class="btn-cancel" onclick="closeEditModal()"><i data-lucide="x" size="18"></i></button>
        </div>
        <form id="editEmployeeForm" action="" method="POST" class="admin-form">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" id="edit_designation" required>
                </div>
            </div>
            <button type="submit" class="btn-submit" style="margin-top: 10px;">
                <i data-lucide="save" size="18"></i> Save Changes
            </button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, email, designation) {
        const modal = document.getElementById('editEmployeeModal');
        const form = document.getElementById('editEmployeeForm');
        
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_designation').value = designation;
        
        form.action = `/admin/employees/${id}`;
        modal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editEmployeeModal').style.display = 'none';
    }
</script>
@endsection
