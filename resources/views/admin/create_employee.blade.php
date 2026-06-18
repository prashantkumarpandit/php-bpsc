@extends('layouts.app')

@section('content')
<div class="admin-page">
    <div class="admin-card">
        <div class="card-header">
            <i data-lucide="user-plus" size="20" class="card-header-icon"></i>
            <h3>Create New Employee</h3>
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

        <form action="{{ route('admin.employees') }}" method="POST" class="admin-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="employee@bpsctech.in" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" name="designation" value="{{ old('designation') }}" placeholder="e.g. System Analyst" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Min. 8 characters" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">
                <i data-lucide="save" size="18"></i> Create Employee Account
            </button>
        </form>
    </div>
</div>
@endsection
