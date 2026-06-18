@extends('layouts.app')

@section('content')
<div class="admin-page">
    <div class="admin-card">
        <div class="card-header">
            <i data-lucide="users" size="20" class="card-header-icon"></i>
            <h3>Form New Departmental Team</h3>
        </div>

        @if(session('success'))
            <div style="margin: 20px 24px; padding: 12px 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="margin: 20px 24px; padding: 12px 16px; background: #fef2f2; color: #b91c1c; border-radius: 8px; border: 1px solid #fecaca;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.teams') }}" method="POST" class="admin-form">
            @csrf
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="name" placeholder="e.g. IT Support Team" required>
            </div>
            <div class="form-group">
                <label>Team Description</label>
                <textarea name="description" placeholder="What is the primary function of this team?"></textarea>
            </div>
            <div class="form-group">
                <label>Assign Members</label>
                <select name="members[]" multiple style="height: 150px;" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->designation }})</option>
                    @endforeach
                </select>
                <small style="color: #64748b; margin-top: 4px;">Hold Ctrl (Windows) or Command (Mac) to select multiple employees.</small>
            </div>
            <button type="submit" class="btn-submit">
                <i data-lucide="shield-check" size="18"></i> Establish Team
            </button>
        </form>
    </div>
</div>
@endsection
