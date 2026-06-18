@extends('layouts.app')

@section('content')
<style>
    .profile-layout {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        align-items: flex-start;
    }
    .profile-sidebar {
        flex: 1;
        min-width: 280px;
        background: #fff;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #f3f4f6;
    }
    .profile-main {
        flex: 2;
        min-width: 400px;
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid #f3f4f6;
    }
    .profile-avatar-wrapper {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        margin: 0 auto 20px;
        border: 4px solid #e0f2fe;
        overflow: hidden;
        position: relative;
        background: #f8fafc;
    }
    .profile-avatar-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .profile-name { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; }
    .profile-role { font-size: 14px; color: #64748b; margin-bottom: 16px; font-weight: 500; }
    .profile-badge { background: #eff6ff; color: #2563eb; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 700; display: inline-block; margin-bottom: 24px; }
    
    .profile-info-list { text-align: left; margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 20px; }
    .profile-info-item { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; color: #475569; font-size: 14px; }
    .profile-info-item i { color: #94a3b8; }

    .edit-section-title { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 24px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px; }
</style>

<div class="admin-page">
    @if(session('success'))
        <div style="margin-bottom: 24px; padding: 14px 20px; background: #ecfdf5; color: #065f46; border-radius: 12px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 10px; font-weight: 500;">
            <i data-lucide="check-circle" size="20"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="margin-bottom: 24px; padding: 14px 20px; background: #fef2f2; color: #b91c1c; border-radius: 12px; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-layout">
        <!-- Left Sidebar: Profile Overview -->
        <div class="profile-sidebar">
            <div class="profile-avatar-wrapper">
                @if($user->profile_pic)
                    <img src="{{ Storage::url($user->profile_pic) }}" alt="Profile">
                @else
                    <img src="/cropped-QT3Rx6On_400x400.png" alt="Profile">
                @endif
            </div>
            <h2 class="profile-name">{{ $user->name }}</h2>
            <div class="profile-role">{{ $user->designation ?? 'System Administrator' }}</div>
            <div class="profile-badge"><i data-lucide="shield-check" size="12" style="display:inline; margin-right:4px;"></i> {{ $user->role }}</div>

            <div class="profile-info-list">
                <div class="profile-info-item">
                    <i data-lucide="mail" size="18"></i>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="profile-info-item">
                    <i data-lucide="calendar" size="18"></i>
                    <span>Joined: {{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Right Main: Edit Profile Form -->
        <div class="profile-main">
            <h3 class="edit-section-title">
                <i data-lucide="edit-3" size="20" style="color: #3b82f6;"></i> Edit Profile Details
            </h3>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="admin-form" style="padding: 0;">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="background: #fff;">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="background: #fff;">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label>Profile Picture</label>
                    <div style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 20px; text-align: center; background: #f8fafc; cursor: pointer;" onclick="document.getElementById('profile_pic_input').click()">
                        <i data-lucide="upload-cloud" size="28" style="color: #64748b; margin-bottom: 10px;"></i>
                        <div style="font-size: 14px; color: #475569; font-weight: 500;">Click to upload a new photo</div>
                        <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">PNG, JPG or GIF (Max 2MB)</div>
                        <input type="file" name="profile_pic" id="profile_pic_input" accept="image/*" style="display: none;">
                    </div>
                </div>

                <h3 class="edit-section-title" style="margin-top: 32px;">
                    <i data-lucide="lock" size="20" style="color: #f59e0b;"></i> Security Settings
                </h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>New Password (Optional)</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current" style="background: #fff;">
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password" style="background: #fff;">
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <button type="submit" class="btn-submit">
                        <i data-lucide="save" size="18"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
