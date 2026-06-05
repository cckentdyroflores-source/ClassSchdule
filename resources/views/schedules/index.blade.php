@extends('layouts.app')

@section('title', 'Class Schedules')
@section('page-title', 'Class Schedules')

@push('styles')
<style>
/* ── Page header ─────────────────────────────────────────── */
.page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 1.75rem;
}
.page-header__title {
    font-size: 22px;
    font-weight: 500;
    letter-spacing: -.3px;
}
.page-header__sub {
    font-size: 13px;
    color: var(--text-muted);
    margin-top: 3px;
}

/* ── Buttons ─────────────────────────────────────────────── */
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #185FA5;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: opacity .15s;
}
.btn-primary:hover { opacity: .88; }

.btn-outline-sm {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    height: 34px;
    padding: 0 14px;
    font-size: 13px;
    background: transparent;
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    color: var(--text-muted);
    cursor: pointer;
    transition: background .12s;
}
.btn-outline-sm:hover { background: var(--bg-secondary, #f9fafb); }

/* ── Filter bar ──────────────────────────────────────────── */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
}
.filter-bar input,
.filter-bar select {
    font-size: 13px;
    padding: 7px 11px;
    height: 34px;
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    background: var(--bg-primary, #fff);
    color: var(--text-primary, #111);
    outline: none;
}
.filter-bar input { width: 210px; }

/* ── Table card ──────────────────────────────────────────── */
.schedule-card {
    background: var(--bg-primary, #fff);
    border: 0.5px solid var(--border-color, #e5e7eb);
    border-radius: 12px;
    overflow: hidden;
}

.schedule-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}
.schedule-table thead th {
    padding: 10px 14px;
    text-align: left;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: .7px;
    text-transform: uppercase;
    color: var(--text-muted);
    border-bottom: 0.5px solid var(--border-color, #e5e7eb);
    white-space: nowrap;
}
.schedule-table tbody tr {
    border-bottom: 0.5px solid var(--border-color, #f3f4f6);
    transition: background .1s;
}
.schedule-table tbody tr:last-child { border-bottom: none; }
.schedule-table tbody tr:hover { background: var(--bg-secondary, #f9fafb); }
.schedule-table td { padding: 11px 14px; vertical-align: middle; }

/* ── Subject cell ────────────────────────────────────────── */
.subject-cell { display: flex; align-items: center; gap: 9px; }
.color-dot {
    width: 9px; height: 9px;
    border-radius: 50%; flex-shrink: 0;
}
.subject-name { font-weight: 500; }

/* ── Day badges ──────────────────────────────────────────── */
.day-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 500;
    padding: 3px 9px;
    border-radius: 99px;
    letter-spacing: .2px;
    white-space: nowrap;
}
.day-badge--mon, .day-badge--tue,
.day-badge--wed, .day-badge--thu { background: #E6F1FB; color: #0C447C; }
.day-badge--fri                  { background: #E1F5EE; color: #085041; }
.day-badge--sat                  { background: #FAEEDA; color: #854F0B; }
.day-badge--sun                  { background: #FAECE7; color: #993C1D; }

/* ── Time ────────────────────────────────────────────────── */
.time-val { font-variant-numeric: tabular-nums; font-size: 13px; color: var(--text-muted); }
.time-sep { color: var(--text-faint, #aaa); margin: 0 3px; }

/* ── Room tag ────────────────────────────────────────────── */
.room-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    padding: 3px 8px;
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    color: var(--text-muted);
    background: var(--bg-secondary, #f9fafb);
}

/* ── Row actions ─────────────────────────────────────────── */
.row-actions { display: flex; align-items: center; gap: 6px; }
.btn-icon {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 8px;
    cursor: pointer;
    border: 0.5px solid var(--border-color, #d1d5db);
    background: transparent;
    color: var(--text-muted);
    transition: background .12s, color .12s;
}
.btn-icon:hover { background: var(--bg-secondary, #f3f4f6); color: var(--text-primary, #111); }
.btn-icon--danger { border-color: transparent; }
.btn-icon--danger:hover { background: #FCEBEB; color: #A32D2D; }

/* ── Empty state ─────────────────────────────────────────── */
.empty-state {
    padding: 3rem 1rem;
    text-align: center;
    color: var(--text-muted);
    font-size: 13.5px;
}

/* ── Modal ───────────────────────────────────────────────── */
.modal-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,.38);
    z-index: 50;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}
.modal-overlay.is-open { display: flex; }

.modal-box {
    background: var(--bg-primary, #fff);
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 12px;
    width: 100%;
    max-width: 520px;
    overflow: hidden;
}
.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.25rem;
    border-bottom: 0.5px solid var(--border-color, #e5e7eb);
}
.modal-header__title { font-size: 16px; font-weight: 500; }
.modal-close-btn {
    background: none; border: none; cursor: pointer;
    color: var(--text-muted);
    padding: 4px;
    border-radius: 6px;
    display: flex; align-items: center;
    font-size: 16px;
    line-height: 1;
}
.modal-close-btn:hover { background: var(--bg-secondary, #f3f4f6); }

.modal-body { padding: 1.25rem; }

.form-group { margin-bottom: 1rem; }
.form-group:last-child { margin-bottom: 0; }
.form-label {
    display: block;
    font-size: 11px;
    font-weight: 500;
    color: var(--text-muted);
    margin-bottom: 5px;
    letter-spacing: .4px;
    text-transform: uppercase;
}
.form-control {
    width: 100%;
    padding: 8px 11px;
    font-size: 13.5px;
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    background: var(--bg-primary, #fff);
    color: var(--text-primary, #111);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.form-control:focus {
    border-color: #185FA5;
    box-shadow: 0 0 0 3px rgba(24,95,165,.12);
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    padding: 1rem 1.25rem;
    border-top: 0.5px solid var(--border-color, #e5e7eb);
}
.btn-cancel {
    padding: 8px 16px;
    font-size: 13px;
    border: 0.5px solid var(--border-color, #d1d5db);
    border-radius: 8px;
    background: transparent;
    color: var(--text-muted);
    cursor: pointer;
}
.btn-cancel:hover { background: var(--bg-secondary, #f3f4f6); }

/* row # */
.row-num { font-size: 12px; color: var(--text-faint, #aaa); }
/* instructor */
.instructor-name { font-size: 13px; color: var(--text-muted); }
</style>
@endpush


@section('content')

<div class="page-header">
    <div>
        <div class="page-header__title">Class schedules</div>
        <div class="page-header__sub">Manage your class schedule entries</div>
    </div>
    <button type="button" class="btn-primary" onclick="openAddSchedule()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Add schedule
    </button>
</div>


{{-- Filter bar --}}
<form method="GET" action="{{ route('schedules.index') }}" class="filter-bar">

    <input
        type="text"
        name="search"
        placeholder="Search schedules…"
        value="{{ request('search') }}"
    >

    <select name="day">
        <option value="">All days</option>
        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                {{ $day }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn-outline-sm">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
        </svg>
        Filter
    </button>

</form>


{{-- Table --}}
<div class="schedule-card">
    <div style="overflow-x:auto;">
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Instructor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            @forelse($schedules ?? [] as $i => $s)

                @php
                    $daySlug = match(strtolower($s->day ?? '')) {
                        'monday'    => 'mon',
                        'tuesday'   => 'tue',
                        'wednesday' => 'wed',
                        'thursday'  => 'thu',
                        'friday'    => 'fri',
                        'saturday'  => 'sat',
                        'sunday'    => 'sun',
                        default     => 'mon',
                    };
                @endphp

                <tr>
                    <td><span class="row-num">{{ $i + 1 }}</span></td>

                    <td>
                        <div class="subject-cell">
                            <span class="color-dot" style="background:{{ $s->color ?? '#185FA5' }};"></span>
                            <span class="subject-name">{{ $s->subject ?? 'N/A' }}</span>
                        </div>
                    </td>

                    <td>
                        <span class="day-badge day-badge--{{ $daySlug }}">
                            {{ $s->day ?? 'N/A' }}
                        </span>
                    </td>

                    <td>
                        <span class="time-val">
                            {{ $s->formatted_start ?? date('H:i', strtotime($s->start_time ?? now())) }}<span class="time-sep">–</span>{{ $s->formatted_end ?? date('H:i', strtotime($s->end_time ?? now())) }}
                        </span>
                    </td>

                    <td>
                        <span class="room-tag">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            {{ $s->room ?? 'N/A' }}
                        </span>
                    </td>

                    <td><span class="instructor-name">{{ $s->instructor ?? 'N/A' }}</span></td>

                    <td>
                        <div class="row-actions">
                            <button
                                type="button"
                                class="btn-icon"
                                onclick="openEditSchedule(
                                    {{ $s->id ?? 0 }},
                                    @js($s->subject),
                                    @js($s->day),
                                    '{{ isset($s->start_time) ? substr($s->start_time, 0, 5) : '' }}',
                                    '{{ isset($s->end_time) ? substr($s->end_time, 0, 5) : '' }}',
                                    @js($s->room),
                                    @js($s->instructor)
                                )"
                            >
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </button>

                            <form
                                method="POST"
                                action="{{ route('schedules.destroy', $s->id ?? 0) }}"
                                style="display:inline;"
                                onsubmit="return confirm('Delete this schedule?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon--danger">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">No schedules found.</div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>


{{-- Modal --}}
<div class="modal-overlay" id="modal-schedule">
    <div class="modal-box">

        <div class="modal-header">
            <div class="modal-header__title" id="sched-modal-title">Add class schedule</div>
            <button type="button" class="modal-close-btn" onclick="closeModal('modal-schedule')" aria-label="Close">
                ✕
            </button>
        </div>

        <form method="POST" id="sched-form" action="{{ route('schedules.store') }}">
            @csrf
            <span id="sched-method-field"></span>

            <div class="modal-body">

                <div class="form-group">
                    <label class="form-label">Subject name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="subject"
                        id="s-subject"
                        placeholder="e.g. Introduction to Computing"
                        required
                    >
                </div>

                <div class="form-row" style="margin-bottom:1rem;">
                    <div class="form-group">
                        <label class="form-label">Day</label>
                        <select class="form-control" name="day" id="s-day" required>
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Room</label>
                        <input
                            type="text"
                            class="form-control"
                            name="room"
                            id="s-room"
                            placeholder="e.g. Lab 101"
                            required
                        >
                    </div>
                </div>

                <div class="form-row" style="margin-bottom:1rem;">
                    <div class="form-group">
                        <label class="form-label">Start time</label>
                        <input type="time" class="form-control" name="start_time" id="s-start" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">End time</label>
                        <input type="time" class="form-control" name="end_time" id="s-end" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Instructor name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="instructor"
                        id="s-instructor"
                        placeholder="Prof. Maria Santos"
                        required
                    >
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal('modal-schedule')">Cancel</button>
                <button type="submit" class="btn-primary">Save schedule</button>
            </div>

        </form>
    </div>
</div>

@endsection


@push('scripts')
<script>
function openModal(id) {
    document.getElementById(id).classList.add('is-open');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('is-open');
}

function openAddSchedule() {
    const form = document.getElementById('sched-form');
    form.action = "{{ route('schedules.store') }}";
    document.getElementById('sched-method-field').innerHTML = '';
    document.getElementById('sched-modal-title').textContent = 'Add class schedule';
    document.getElementById('s-subject').value    = '';
    document.getElementById('s-day').value        = 'Monday';
    document.getElementById('s-room').value       = '';
    document.getElementById('s-instructor').value = '';
    document.getElementById('s-start').value      = '08:00';
    document.getElementById('s-end').value        = '09:30';
    openModal('modal-schedule');
}

function openEditSchedule(id, subject, day, start, end, room, instructor) {
    const form = document.getElementById('sched-form');
    form.action = "/schedules/" + id;
    document.getElementById('sched-method-field').innerHTML =
        '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('sched-modal-title').textContent = 'Edit schedule';
    document.getElementById('s-subject').value    = subject    ?? '';
    document.getElementById('s-day').value        = day        ?? 'Monday';
    document.getElementById('s-start').value      = start      ?? '';
    document.getElementById('s-end').value        = end        ?? '';
    document.getElementById('s-room').value       = room       ?? '';
    document.getElementById('s-instructor').value = instructor ?? '';
    openModal('modal-schedule');
}

// Close on backdrop click
document.getElementById('modal-schedule').addEventListener('click', function(e) {
    if (e.target === this) closeModal('modal-schedule');
});
</script>
@endpush