@extends('layouts.app')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto;">
    
    <!-- Welcome Profile Hero -->
    <div class="emp-welcome-card">
        <div class="emp-avatar">
            @if(auth()->user()->profile_pic)
                <img src="{{ Storage::url(auth()->user()->profile_pic) }}" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <img src="/cropped-QT3Rx6On_400x400.png" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
        </div>
        <div class="emp-info">
            <h2>Welcome, {{ auth()->user()->name }}</h2>
            <div class="emp-meta">
                <div class="emp-meta-item">
                    <i data-lucide="briefcase" size="16"></i>
                    <span style="font-weight: 600;">{{ auth()->user()->designation }}</span>
                </div>
                <div class="emp-meta-item">
                    <i data-lucide="mail" size="16"></i>
                    <span>{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Stats Grid -->
    <div class="emp-stat-grid">
        <div class="emp-stat-card" style="border-left: 4px solid #4a5568;">
            <h4>Total Tasks</h4>
            <h2>{{ $stats['totalTasks'] }}</h2>
        </div>
        <div class="emp-stat-card" style="border-left: 4px solid #3182ce;">
            <h4>Active Tasks</h4>
            <h2>{{ $stats['activeTasks'] }}</h2>
        </div>
        <div class="emp-stat-card" style="border-left: 4px solid #38a169;">
            <h4>Completed</h4>
            <h2>{{ $stats['completedTasks'] }}</h2>
        </div>
    </div>

    <!-- Progress Overview Chart -->
    <div class="admin-card chart-card">
        <div class="card-header" style="padding: 0 0 20px 0; background: none; border-bottom: none;">
            <h3 style="display: flex; align-items: center; gap: 8px;"><i data-lucide="bar-chart-2" size="20" class="card-header-icon"></i> My Progress Overview</h3>
        </div>
        <div style="height: 350px; width: 100%;">
            <canvas id="employeeProgressChart"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('employeeProgressChart').getContext('2d');
    
    // Create Gradients
    const gradCompleted = ctx.createLinearGradient(0, 0, 0, 400);
    gradCompleted.addColorStop(0, '#38a169');
    gradCompleted.addColorStop(1, '#2f855a');
    
    const gradInProgress = ctx.createLinearGradient(0, 0, 0, 400);
    gradInProgress.addColorStop(0, '#3182ce');
    gradInProgress.addColorStop(1, '#2b6cb0');
    
    const gradPending = ctx.createLinearGradient(0, 0, 0, 400);
    gradPending.addColorStop(0, '#dd6b20');
    gradPending.addColorStop(1, '#c05621');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                label: 'Task Count',
                data: [{{ $chartData['Completed'] }}, {{ $chartData['In Progress'] }}, {{ $chartData['Pending'] }}],
                backgroundColor: [gradCompleted, gradInProgress, gradPending],
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 60,
                hoverBackgroundColor: [
                    '#276749', '#2c5282', '#9c4221'
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
                    titleColor: '#2d3748',
                    bodyColor: '#4a5568',
                    borderColor: '#e2e8f0',
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
                        color: '#f1f5f9',
                        drawBorder: false,
                        lineWidth: 1.5
                    },
                    ticks: { stepSize: 1, color: '#718096', padding: 10, font: { size: 13, family: "'Inter', sans-serif" } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#4a5568', padding: 10, font: { size: 14, weight: '600', family: "'Inter', sans-serif" } }
                }
            }
        }
    });
});
</script>
@endsection
