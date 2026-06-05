
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

<style>
  *, *::before, *::after { box-sizing: border-box; }

  :root {
    --bg-page:        #F5F5F3;
    --bg-card:        #FFFFFF;
    --bg-muted:       #F1EFE8;
    --text-primary:   #1A1A18;
    --text-secondary: #5F5E5A;
    --text-muted:     #888780;
    --border:         rgba(0,0,0,.08);
    --border-strong:  rgba(0,0,0,.14);
    --border-color:   #d1d5db;
    --bg-primary:     #ffffff;
    --bg-secondary:   #f9fafb;
    --radius-md:      8px;
    --radius-lg:      12px;
    --blue-bg:        #E6F1FB;
    --blue-text:      #0C447C;
    --blue-mid:       #185FA5;
    --green-bg:       #EAF3DE;
    --green-text:     #27500A;
    --amber-bg:       #FAEEDA;
    --amber-text:     #633806;
    --red-bg:         #FCEBEB;
    --red-text:       #791F1F;
  }

  /* ── Layout ── */
  .dash-wrap { display: flex; flex-direction: column; gap: 1.5rem; padding: 1.5rem 0; }

  /* ── Page header ── */
  .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
  .page-header h1 { font-size: 20px; font-weight: 500; color: var(--text-primary); margin: 0; }
  .page-header p  { font-size: 13px; color: var(--text-secondary); margin: 4px 0 0; }

  /* ── Buttons ── */
  .btn {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 500; padding: 8px 16px;
    border-radius: var(--radius-md); border: 0.5px solid var(--border-strong);
    background: var(--bg-card); color: var(--text-primary);
    cursor: pointer; transition: background .15s; text-decoration: none;
  }
  .btn:hover         { background: var(--bg-muted); }
  .btn-primary       { background: var(--blue-mid); border-color: var(--blue-mid); color: #fff; }
  .btn-primary:hover { background: var(--blue-text); }
  .btn-sm            { font-size: 12px; padding: 6px 12px; }

  /* ── Metric cards ── */
  .metric-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; }
  .metric-card { background: var(--bg-muted); border-radius: var(--radius-md); padding: 1rem; display: flex; flex-direction: column; gap: 6px; }
  .mc-icon { width: 36px; height: 36px; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; font-size: 18px; }
  .mc-icon.blue  { background: var(--blue-bg);  color: var(--blue-mid);   }
  .mc-icon.green { background: var(--green-bg); color: var(--green-text); }
  .mc-icon.amber { background: var(--amber-bg); color: var(--amber-text); }
  .mc-icon.red   { background: var(--red-bg);   color: var(--red-text);   }
  .mc-label { font-size: 12px; color: var(--text-secondary); }
  .mc-val   { font-size: 24px; font-weight: 500; color: var(--text-primary); line-height: 1; }
  .mc-trend { font-size: 12px; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }
  .mc-trend.up { color: var(--green-text); }

  /* ── Two-column row ── */
  .dash-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
  @media (max-width: 640px) { .dash-row { grid-template-columns: 1fr; } }

  /* ── Panel ── */
  .panel { background: var(--bg-card); border: 0.5px solid var(--border); border-radius: var(--radius-lg); padding: 1.25rem; }
  .panel-head  { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.25rem; }
  .panel-title { font-size: 14px; font-weight: 500; color: var(--text-primary); }
  .panel-sub   { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

  /* ── Chart ── */
  .chart-wrap { position: relative; height: 200px; width: 100%; }

  /* ── Activity feed ── */
  .activity { display: flex; flex-direction: column; gap: 0; }
  .act-row { display: flex; align-items: center; gap: 10px; padding: .75rem 0; }
  .act-row + .act-row { border-top: 0.5px solid var(--border); }
  .act-avatar { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 500; flex-shrink: 0; }
  .av-a { background: var(--blue-bg);  color: var(--blue-text);  }
  .av-t { background: var(--green-bg); color: var(--green-text); }
  .av-s { background: var(--amber-bg); color: var(--amber-text); }
  .act-name { font-size: 13px; font-weight: 500; color: var(--text-primary); }
  .act-time { font-size: 12px; color: var(--text-muted); }
  .act-dot  { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-left: auto; }

  /* ── Data table ── */
  .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
  .data-table th { padding: 8px 12px; text-align: left; font-weight: 500; font-size: 11px; letter-spacing: .5px; text-transform: uppercase; color: var(--text-muted); border-bottom: 0.5px solid var(--border); white-space: nowrap; }
  .data-table td { padding: 10px 12px; border-bottom: 0.5px solid var(--border); color: var(--text-primary); vertical-align: middle; }
  .data-table tbody tr:last-child td { border-bottom: none; }
  .data-table tbody tr:hover td { background: var(--bg-muted); }

  /* ── Subject cell (matches index) ── */
  .subject-cell { display: flex; align-items: center; gap: 9px; }
  .color-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
  .subject-name { font-weight: 500; }

  /* ── Room tag (matches index) ── */
  .room-tag {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 12px; padding: 3px 8px;
    border: 0.5px solid var(--border-color); border-radius: 8px;
    color: var(--text-muted); background: var(--bg-secondary);
  }

  /* ── Day badges (matches index exactly) ── */
  .day-badge {
    display: inline-block; font-size: 11px; font-weight: 500;
    padding: 3px 9px; border-radius: 99px; letter-spacing: .2px; white-space: nowrap;
  }
  .day-badge--mon, .day-badge--tue,
  .day-badge--wed, .day-badge--thu { background: #E6F1FB; color: #0C447C; }
  .day-badge--fri                  { background: #E1F5EE; color: #085041; }
  .day-badge--sat                  { background: #FAEEDA; color: #854F0B; }
  .day-badge--sun                  { background: #FAECE7; color: #993C1D; }

  /* ── Time (matches index) ── */
  .time-val { font-variant-numeric: tabular-nums; font-size: 13px; color: var(--text-muted); }
  .time-sep { color: #aaa; margin: 0 3px; }

  /* ── Instructor ── */
  .instructor-name { font-size: 13px; color: var(--text-muted); }

  /* ── Empty state ── */
  .empty-state { padding: 2rem 1rem; text-align: center; color: var(--text-muted); font-size: 13.5px; }

  /* ── Modal ── */
  .modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.38); z-index: 50;
    align-items: center; justify-content: center; padding: 1.5rem;
  }
  .modal-overlay.is-open { display: flex; }
  .modal-box {
    background: var(--bg-primary); border: 0.5px solid var(--border-color);
    border-radius: 12px; width: 100%; max-width: 520px; overflow: hidden;
  }
  .modal-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 1rem 1.25rem; border-bottom: 0.5px solid var(--border-color);
  }
  .modal-header__title { font-size: 16px; font-weight: 500; }
  .modal-close-btn {
    background: none; border: none; cursor: pointer; color: var(--text-muted);
    padding: 4px; border-radius: 6px; display: flex; align-items: center;
    font-size: 16px; line-height: 1;
  }
  .modal-close-btn:hover { background: var(--bg-secondary); }
  .modal-body { padding: 1.25rem; }
  .form-group { margin-bottom: 1rem; }
  .form-group:last-child { margin-bottom: 0; }
  .form-label {
    display: block; font-size: 11px; font-weight: 500; color: var(--text-muted);
    margin-bottom: 5px; letter-spacing: .4px; text-transform: uppercase;
  }
  .form-control {
    width: 100%; padding: 8px 11px; font-size: 13.5px;
    border: 0.5px solid var(--border-color); border-radius: 8px;
    background: var(--bg-primary); color: var(--text-primary);
    outline: none; transition: border-color .15s, box-shadow .15s;
  }
  .form-control:focus { border-color: #185FA5; box-shadow: 0 0 0 3px rgba(24,95,165,.12); }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
  .modal-footer {
    display: flex; justify-content: flex-end; gap: 8px;
    padding: 1rem 1.25rem; border-top: 0.5px solid var(--border-color);
  }
  .btn-cancel {
    padding: 8px 16px; font-size: 13px; border: 0.5px solid var(--border-color);
    border-radius: 8px; background: transparent; color: var(--text-muted); cursor: pointer;
  }
  .btn-cancel:hover { background: var(--bg-secondary); }
</style>

<div class="dash-wrap">

  
  <div class="page-header">
    <div>
      <h1>Dashboard overview</h1>
      <p>Monitor schedules, users, and system activity in real time.</p>
    </div>
    <button type="button" class="btn btn-primary" onclick="openAddSchedule()">
      <i class="ti ti-plus"></i> Add schedule
    </button>
  </div>

  
  
  <div class="metric-grid">
    <div class="metric-card">
      <div class="mc-icon blue"><i class="ti ti-school"></i></div>
      <div class="mc-label">Total students</div>
      <div class="mc-val"><?php echo e(number_format($totalStudents ?? 0)); ?></div>
      <div class="mc-trend up">
        <i class="ti ti-trending-up" style="font-size:13px"></i> Active enrollees
      </div>
    </div>
    <div class="metric-card">
      <div class="mc-icon green"><i class="ti ti-users"></i></div>
      <div class="mc-label">Teachers</div>
      <div class="mc-val"><?php echo e(number_format($totalTeachers ?? 0)); ?></div>
      <div class="mc-trend">Active faculty</div>
    </div>
    <div class="metric-card">
      <div class="mc-icon amber"><i class="ti ti-calendar"></i></div>
      <div class="mc-label">Schedules</div>
      <div class="mc-val"><?php echo e(number_format($totalSchedules ?? 0)); ?></div>
      <div class="mc-trend">Total entries</div>
    </div>
    <div class="metric-card">
      <div class="mc-icon red"><i class="ti ti-building"></i></div>
      <div class="mc-label">Rooms</div>
      <div class="mc-val"><?php echo e(number_format($totalRooms ?? 0)); ?></div>
      <div class="mc-trend">Registered rooms</div>
    </div>
  </div>

  
  <div class="dash-row">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Weekly schedule analytics</div>
          <div class="panel-sub">Classes per day this week</div>
        </div>
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-muted)">
          <span style="width:10px;height:10px;border-radius:2px;background:#185FA5;display:inline-block"></span>
          Classes
        </div>
      </div>
      <div class="chart-wrap">
        <canvas id="scheduleChart"></canvas>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div class="panel-title">Recent activity</div>
      </div>
      <div class="activity">
        <div class="act-row">
          <div class="act-avatar av-a">A</div>
          <div style="flex:1">
            <div class="act-name">Admin added new schedule</div>
            <div class="act-time">5 minutes ago</div>
          </div>
          <div class="act-dot" style="background:#185FA5"></div>
        </div>
        <div class="act-row">
          <div class="act-avatar av-t">T</div>
          <div style="flex:1">
            <div class="act-name">Teacher updated classroom</div>
            <div class="act-time">30 minutes ago</div>
          </div>
          <div class="act-dot" style="background:#639922"></div>
        </div>
        <div class="act-row">
          <div class="act-avatar av-s">S</div>
          <div style="flex:1">
            <div class="act-name">Schedule conflict resolved</div>
            <div class="act-time">1 hour ago</div>
          </div>
          <div class="act-dot" style="background:#BA7517"></div>
        </div>
      </div>
    </div>
  </div>

  
  
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Recent class schedules</div>
        <div class="panel-sub">
          Latest <?php echo e(($recentSchedules ?? collect())->count()); ?> of <?php echo e(number_format($totalSchedules ?? 0)); ?> schedules
        </div>
      </div>
      <a href="<?php echo e(route('schedules.index')); ?>" class="btn btn-sm">
        View all <i class="ti ti-arrow-right" style="font-size:13px"></i>
      </a>
    </div>

    <div style="overflow-x:auto;">
      <table class="data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Day</th>
            <th>Time</th>
            <th>Room</th>
            <th>Instructor</th>
          </tr>
        </thead>
        <tbody>

        <?php $__empty_1 = true; $__currentLoopData = ($recentSchedules ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php
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
          ?>
          <tr>
            <td style="font-size:12px;color:var(--text-muted)"><?php echo e($i + 1); ?></td>

            <td>
              <div class="subject-cell">
                <span class="color-dot" style="background:<?php echo e($s->color ?? '#185FA5'); ?>;"></span>
                <span class="subject-name"><?php echo e($s->subject ?? 'N/A'); ?></span>
              </div>
            </td>

            <td>
              <span class="day-badge day-badge--<?php echo e($daySlug); ?>">
                <?php echo e($s->day ?? 'N/A'); ?>

              </span>
            </td>

            <td>
              <span class="time-val">
                <?php echo e($s->formatted_start ?? date('h:i A', strtotime($s->start_time ?? 'now'))); ?><span class="time-sep">–</span><?php echo e($s->formatted_end ?? date('h:i A', strtotime($s->end_time ?? 'now'))); ?>

              </span>
            </td>

            <td>
              <span class="room-tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                <?php echo e($s->room ?? 'N/A'); ?>

              </span>
            </td>

            <td><span class="instructor-name"><?php echo e($s->instructor ?? 'N/A'); ?></span></td>
          </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="6">
              <div class="empty-state">No schedules yet. Add one above!</div>
            </td>
          </tr>
        <?php endif; ?>

        </tbody>
      </table>
    </div>
  </div>

</div>



<div class="modal-overlay" id="modal-schedule">
  <div class="modal-box">

    <div class="modal-header">
      <div class="modal-header__title">Add class schedule</div>
      <button type="button" class="modal-close-btn" onclick="closeModal('modal-schedule')" aria-label="Close">✕</button>
    </div>

    <form method="POST" id="sched-form" action="<?php echo e(route('schedules.store')); ?>">
      <?php echo csrf_field(); ?>

      <div class="modal-body">

        <div class="form-group">
          <label class="form-label">Subject name</label>
          <input
            type="text" class="form-control" name="subject" id="s-subject"
            placeholder="e.g. Introduction to Computing" required
          >
        </div>

        <div class="form-row" style="margin-bottom:1rem;">
          <div class="form-group">
            <label class="form-label">Day</label>
            <select class="form-control" name="day" id="s-day" required>
              <?php $__currentLoopData = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($day); ?>"><?php echo e($day); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Room</label>
            <input
              type="text" class="form-control" name="room" id="s-room"
              placeholder="e.g. Lab 101" required
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
            type="text" class="form-control" name="instructor" id="s-instructor"
            placeholder="Prof. Maria Santos" required
          >
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeModal('modal-schedule')">Cancel</button>
        <button type="submit" class="btn btn-primary">Save schedule</button>
      </div>

    </form>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  <?php
    // Shorten day labels for the chart x-axis: Monday → Mon, etc.
    $chartLabels = collect($days)->map(fn($d) => substr($d, 0, 3))->toArray();
  ?>

  new Chart(document.getElementById('scheduleChart'), {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($chartLabels); ?>,
      datasets: [{
        label: 'Classes',
        data: <?php echo json_encode($classesPerDay); ?>,
        backgroundColor: '#185FA5',
        borderRadius: 6,
        borderSkipped: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: { label: ctx => `${ctx.parsed.y} classes` }
        }
      },
      scales: {
        x: { grid: { display: false }, border: { display: false }, ticks: { color: '#888780', font: { size: 12 } } },
        y: { beginAtZero: true, border: { display: false, dash: [3,3] }, grid: { color: 'rgba(0,0,0,.06)' }, ticks: { color: '#888780', font: { size: 12 }, stepSize: 1 } }
      }
    }
  });

  /* ── Modal helpers ── */
  function openModal(id)  { document.getElementById(id).classList.add('is-open'); }
  function closeModal(id) { document.getElementById(id).classList.remove('is-open'); }

  function openAddSchedule() {
    document.getElementById('sched-form').reset();
    document.getElementById('s-day').value   = 'Monday';
    document.getElementById('s-start').value = '08:00';
    document.getElementById('s-end').value   = '09:30';
    openModal('modal-schedule');
  }

  /* Close on backdrop click */
  document.getElementById('modal-schedule').addEventListener('click', function(e) {
    if (e.target === this) closeModal('modal-schedule');
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ClassSchedule\resources\views/dashboard.blade.php ENDPATH**/ ?>