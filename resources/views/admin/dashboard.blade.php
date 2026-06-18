@extends('layouts.app')

@section('content')
<div class="admin-page">
    <div class="admin-hero">
        <div class="admin-hero-avatar">
            <img src="/cropped-QT3Rx6On_400x400.png" alt="Admin Avatar">
        </div>
        <div class="admin-hero-info">
            <h2>{{ auth()->user()->name }}</h2>
            <div class="admin-hero-badges">
                <span class="badge-role"><i data-lucide="user" size="14"></i> {{ auth()->user()->designation }}</span>
                <span class="badge-email"><i data-lucide="mail" size="14"></i> {{ auth()->user()->email }}</span>
            </div>
            <p class="hero-desc">Welcome to the BPSC Technical Administration Portal. Manage employees, assign tasks, oversee ongoing projects, and coordinate departmental teams effectively from this central command center.</p>
        </div>
    <div class="admin-hero-meta">
        <div>
            <span>{{ $stats['totalTasks'] }}</span>
            <small>Total Tasks</small>
        </div>
        <div>
            <span>{{ $stats['completedTasks'] }}</span>
            <small>Completed</small>
        </div>
        <div>
            <span>{{ $stats['employees'] }}</span>
            <small>Employees</small>
        </div>
    </div>
</div>

<div class="stat-grid">
    <div class="stat-card stat-total">
        <div class="stat-icon"><i data-lucide="bar-chart-2" size="26"></i></div>
        <div>
            <h3 class="stat-value">{{ $stats['totalTasks'] }}</h3>
            <p class="stat-label">Total Tasks</p>
        </div>
    </div>
    <div class="stat-card stat-active">
        <div class="stat-icon"><i data-lucide="clock" size="26"></i></div>
        <div>
            <h3 class="stat-value">{{ $stats['activeTasks'] }}</h3>
            <p class="stat-label">Active Tasks</p>
        </div>
    </div>
    <div class="stat-card stat-done">
        <div class="stat-icon"><i data-lucide="check-circle" size="26"></i></div>
        <div>
            <h3 class="stat-value">{{ $stats['completedTasks'] }}</h3>
            <p class="stat-label">Completed</p>
        </div>
    </div>
    <div class="stat-card stat-emp">
        <div class="stat-icon"><i data-lucide="users" size="26"></i></div>
        <div>
            <h3 class="stat-value">{{ $stats['employees'] }}</h3>
            <p class="stat-label">Employees</p>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="admin-card chart-card">
    <div class="card-header" style="padding: 0 0 20px 0; background: none; border-bottom: none;">
        <h3 style="display: flex; align-items: center; gap: 8px;"><i data-lucide="bar-chart-2" size="20" class="card-header-icon"></i> Task Overview</h3>
    </div>
    <div style="height: 350px; width: 100%;">
        <canvas id="taskChart"></canvas>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('taskChart').getContext('2d');
    
    // Create Gradients for a premium look
    const gradCompleted = ctx.createLinearGradient(0, 0, 0, 400);
    gradCompleted.addColorStop(0, '#10b981'); // Light Green
    gradCompleted.addColorStop(1, '#059669'); // Dark Green
    
    const gradInProgress = ctx.createLinearGradient(0, 0, 0, 400);
    gradInProgress.addColorStop(0, '#3b82f6'); // Light Blue
    gradInProgress.addColorStop(1, '#2563eb'); // Dark Blue
    
    const gradPending = ctx.createLinearGradient(0, 0, 0, 400);
    gradPending.addColorStop(0, '#f59e0b'); // Light Orange
    gradPending.addColorStop(1, '#d97706'); // Dark Orange

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                label: 'Number of Tasks',
                data: [{{ $chartData['Completed'] }}, {{ $chartData['In Progress'] }}, {{ $chartData['Pending'] }}],
                backgroundColor: [gradCompleted, gradInProgress, gradPending],
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 60,
                hoverBackgroundColor: [
                    '#059669', '#1d4ed8', '#b45309'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                y: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#111827',
                    bodyColor: '#4b5563',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 14,
                    boxPadding: 8,
                    cornerRadius: 12,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.formattedValue + ' Tasks';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { 
                        color: '#f3f4f6', 
                        drawBorder: false,
                        lineWidth: 1.5
                    },
                    ticks: { color: '#6b7280', font: { size: 13, family: "'Inter', sans-serif" }, stepSize: 1, padding: 10 }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#4b5563', font: { size: 14, weight: '600', family: "'Inter', sans-serif" }, padding: 10 }
                }
            }
        }
    });
});
</script>
@endsection

