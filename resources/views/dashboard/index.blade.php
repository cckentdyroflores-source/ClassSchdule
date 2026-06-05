@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <div class="page-title">Dashboard</div>
        <div class="page-sub">Welcome back, {{ auth()->user()->name }}!</div>
    </div>
</div>

<div class="metric-grid">
    <div class="metric-card">
        <div class="mc-icon blue">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <div class="mc-label">Total Users</div>
        <div class="mc-val">{{ $totalUsers }}</div>
        <div class="mc-trend">↑ Active accounts</div>
    </div>
    <div class="metric-card">
        <div class="mc-icon green">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="mc-label">Total Schedules</div>
        <div class="mc-val">{{ $totalSchedules }}</div>
        <div class="mc-trend">↑ All entries</div>
    </div>
    <div class="metric-card">
        <div class="mc-icon amber">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <div class="mc-label">Active Subjects</div>
        <div class="mc-val">{{ $totalSubjects }}</div>
        <div class="mc-trend">Across all sections</div>
    </div>
    <div class="metric-card">
        <div class="mc-icon red">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" width="22" height="22"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/></svg>
        </div>
        <div class="mc-label">Rooms Used</div>
        <div class="mc-val">{{ $totalRooms }}</div>
        <div class="mc-trend">Unique rooms</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
    <div class="card-panel">
        <div class="cp-header"><div class="cp-title">Classes Per Day</div></div>
        <div class="chart-wrap"><canvas id="chart-day"></canvas></div>
    </div>
    <div class="card-panel">
        <div class="cp-header"><div class="cp-title">Subjects Distribution</div></div>
        <div class="chart-wrap"><canvas id="chart-subject"></canvas></div>
    </div>
</div>

<div class="card-panel">
    <div class="cp-header">
        <div class="cp-title">Recent Schedules</div>
        <a href="{{ route('schedules.index') }}" class="btn-accent">View All</a>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Instructor</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentSchedules as $s)
                <tr>
                    <td><span class="color-dot" style="background:{{ $s->color }};"></span><strong>{{ $s->subject }}</strong></td>
                    <td><span class="badge-day {{ $s->day_color_class }}">{{ $s->day }}</span></td>
                    <td>{{ $s->formatted_start }} – {{ $s->formatted_end }}</td>
                    <td><span class="tag-room">{{ $s->room }}</span></td>
                    <td>{{ $s->instructor }}</td>
                </tr>
                @empty
                <tr><td colspan="5"><div class="empty-state">No schedules yet.</div></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
var dayData = @json($classesPerDay);
var dayLabels = @json($days);
var subjectLabels = @json($subjectLabels);
var subjectCounts = @json($subjectCounts);
var schedColors = ['#4f7cff','#22d3a5','#f87171','#fbbf24','#a78bfa','#34d399','#fb923c','#f472b6'];

new Chart(document.getElementById('chart-day'), {
    type: 'bar',
    data: {
        labels: dayLabels,
        datasets: [{
            data: dayData,
            backgroundColor: schedColors,
            borderRadius: 8,
            borderSkipped: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
        }
    }
});

new Chart(document.getElementById('chart-subject'), {
    type: 'doughnut',
    data: {
        labels: subjectLabels,
        datasets: [{
            data: subjectCounts,
            backgroundColor: schedColors.slice(0, subjectLabels.length),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 11 }, boxWidth: 12, padding: 8 }
            }
        },
        cutout: '65%'
    }
});
</script>
@endpush