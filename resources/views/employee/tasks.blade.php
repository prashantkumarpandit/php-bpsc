@extends('layouts.app')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto;">
    
    <div class="admin-card table-card">
        <div class="card-header">
            <h3 style="display: flex; align-items: center; gap: 8px;">
                <i data-lucide="clipboard-list" size="22" class="card-header-icon"></i>
                <span style="color: #718096; font-weight: 400; font-size: 1rem;">Tasks &raquo;</span>
                My Assigned Tasks
            </h3>
            <span class="badge-count">{{ count($tasks) }} Total</span>
        </div>

        @if(session('success'))
            <div style="margin: 20px 24px; padding: 12px 16px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle" size="18"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-scroll" style="padding: 0 20px 20px 20px;">
            <table class="bpsc-table" style="margin-top: 10px; width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left; padding: 12px 15px;">Task Title</th>
                        <th style="text-align: left; padding: 12px 15px;">Assignment</th>
                        <th style="text-align: left; padding: 12px 15px;">Description</th>
                        <th style="text-align: center; padding: 12px 15px;">Status</th>
                        <th style="text-align: center; padding: 12px 15px;">Assigned</th>
                        <th style="text-align: center; padding: 12px 15px;">Due Date</th>
                        <th style="text-align: center; padding: 12px 15px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                        <tr>
                            <td style="text-align: left; padding: 12px 15px; font-weight: 600; color: #2d3748;">{{ $task->title }}</td>
                            <td style="text-align: left; padding: 12px 15px;">
                                @if($task->team)
                                    <span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; color: #1a202c; display: inline-block;">👥 {{ $task->team->name }}</span>
                                @else
                                    <span style="background: #edf2f7; padding: 4px 8px; border-radius: 4px; font-size: 11px; color: #4a5568; display: inline-block;">👤 Personal</span>
                                @endif
                            </td>
                            <td style="text-align: left; padding: 12px 15px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $task->description }}">
                                {{ $task->description }}
                            </td>
                            <td style="text-align: center; padding: 12px 15px;">
                                @php
                                    $statusClass = [
                                        'Completed' => 'status-completed',
                                        'In Progress' => 'status-in-progress',
                                        'Pending' => 'status-pending'
                                    ];
                                @endphp
                                <span class="status-badge {{ $statusClass[$task->status] ?? '' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td style="text-align: center; padding: 12px 15px;">{{ $task->created_at->format('d/m/Y') }}</td>
                            <td style="text-align: center; padding: 12px 15px; color: #e53e3e; font-weight: 600;">{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'N/A' }}</td>
                            <td style="text-align: center; padding: 12px 15px;">
                                <form action="{{ url('/dashboard/tasks/'.$task->id.'/status') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" style="padding: 6px 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 12px; background: #f8fafc; cursor: pointer; width: 100%; max-width: 110px;">
                                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: #718096; font-style: italic;">No tasks assigned yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
