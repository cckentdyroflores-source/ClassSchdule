<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title", "Class Schedule System")</title>

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width: 240px;
            --accent: #2563EB;
            --accent-light: #EFF6FF;
        }

        body { background: #F8FAFC; font-size: 14px; }

        /* ── Sidebar ───────────────────────── */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }
        .sidebar-brand {
            padding: 20px 18px 16px;
            border-bottom: 1px solid #E2E8F0;
        }
        .brand-icon {
            width: 36px; height: 36px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 18px; margin-bottom: 10px;
        }
        .brand-name { font-size: 13px; font-weight: 600; color: #1E293B; line-height: 1.3; }
        .brand-sub  { font-size: 11px; color: #94A3B8; }

        .sidebar-section {
            padding: 14px 18px 4px;
            font-size: 10px; font-weight: 600;
            color: #94A3B8; text-transform: uppercase; letter-spacing: .06em;
        }
        .nav-item a {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 14px;
            border-radius: 8px;
            margin: 1px 8px;
            font-size: 13px; font-weight: 500;
            color: #64748B;
            text-decoration: none;
            transition: background .15s, color .15s;
        }
        .nav-item a:hover  { background: #F1F5F9; color: #1E293B; }
        .nav-item a.active { background: var(--accent-light); color: var(--accent); }
        .nav-item a i      { font-size: 16px; width: 18px; }
        .nav-badge {
            margin-left: auto;
            background: var(--accent-light); color: var(--accent);
            font-size: 10px; font-weight: 600;
            padding: 2px 8px; border-radius: 20px;
        }
        .sidebar-footer {
            margin-top: auto;
            padding: 12px 8px;
            border-top: 1px solid #E2E8F0;
        }
        .user-chip {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 10px; border-radius: 8px; cursor: pointer;
            text-decoration: none; color: inherit;
        }
        .user-chip:hover { background: #F1F5F9; }
        .user-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--accent-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 600; color: var(--accent);
            overflow: hidden; flex-shrink: 0;
        }
        .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
        /* ✅ Fixed: renamed .u-name/.u-role to match HTML class names */
        .user-name { font-size: 12px; font-weight: 600; color: #1E293B; }
        .user-role { font-size: 11px; color: #94A3B8; }

        /* ── Main area ─────────────────────── */
        .main-content {
            margin-left: var(--sidebar-width);
            display: flex; flex-direction: column; min-height: 100vh;
        }
        .topbar {
            height: 56px; background: #fff;
            border-bottom: 1px solid #E2E8F0;
            display: flex; align-items: center;
            padding: 0 24px; gap: 12px;
            position: sticky; top: 0; z-index: 900;
        }
        .topbar-title { font-size: 15px; font-weight: 600; color: #1E293B; flex: 1; }
        .page-content { padding: 24px; flex: 1; }

        /* ── Cards ─────────────────────────── */
        .card { border: 1px solid #E2E8F0; border-radius: 12px; }
        .card-header { border-bottom: 1px solid #E2E8F0; background: #fff; border-radius: 12px 12px 0 0 !important; }
        .stat-card {
            background: #fff; border: 1px solid #E2E8F0;
            border-radius: 12px; padding: 18px;
        }
        .stat-label { font-size: 12px; color: #64748B; margin-bottom: 6px; }
        .stat-value { font-size: 28px; font-weight: 700; line-height: 1; }
        .stat-note  { font-size: 11px; color: #94A3B8; margin-top: 6px; }

        /* ── Tables ────────────────────────── */
        .table thead th {
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .04em;
            color: #64748B; background: #F8FAFC;
            border-bottom: 1px solid #E2E8F0; padding: 10px 14px;
        }
        .table tbody td { padding: 11px 14px; vertical-align: middle; font-size: 13px; }
        .table-wrap { background: #fff; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; }

        /* ── Badges ────────────────────────── */
        .badge-active   { background: #F0FDF4; color: #16A34A; font-size: 11px; font-weight: 600; }
        .badge-inactive { background: #FFFBEB; color: #D97706; font-size: 11px; font-weight: 600; }
        .badge-admin    { background: #EFF6FF; color: #2563EB; font-size: 11px; font-weight: 600; }
        .badge-teacher  { background: #F5F3FF; color: #7C3AED; font-size: 11px; font-weight: 600; }
        .badge-student  { background: #F0FDF4; color: #16A34A; font-size: 11px; font-weight: 600; }
        .day-chip {
            display: inline-block; padding: 2px 8px;
            background: #EFF6FF; color: #2563EB;
            border-radius: 4px; font-size: 11px; font-weight: 600;
        }

        /* ── Forms ─────────────────────────── */
        .form-label { font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .form-control, .form-select {
            font-size: 13px; border-color: #E2E8F0;
            border-radius: 8px; padding: 8px 12px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--accent); box-shadow: 0 0 0 3px rgba(37,99,235,.1);
        }
        .form-section {
            background: #fff; border: 1px solid #E2E8F0;
            border-radius: 12px; padding: 20px; margin-bottom: 16px;
        }
        .form-section-title {
            font-size: 13px; font-weight: 600; color: #1E293B;
            padding-bottom: 12px; border-bottom: 1px solid #E2E8F0;
            margin-bottom: 16px; display: flex; align-items: center; gap: 8px;
        }
        .form-section-title i { color: var(--accent); }

        /* ── Buttons ───────────────────────── */
        .btn-primary { background: var(--accent); border-color: var(--accent); font-size: 13px; font-weight: 500; }
        .btn-primary:hover { background: #1D4ED8; border-color: #1D4ED8; }
        .btn-sm { font-size: 12px; padding: 5px 10px; }
        .btn-outline-secondary { font-size: 13px; border-color: #E2E8F0; color: #64748B; }
        .btn-outline-secondary:hover { background: #F1F5F9; border-color: #E2E8F0; color: #1E293B; }

        /* ── Toast ─────────────────────────── */
        .toast-container-fixed {
            position: fixed; bottom: 20px; right: 20px;
            z-index: 9999; display: flex; flex-direction: column; gap: 8px;
        }

        /* ── Responsive ────────────────────── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); transition: transform .3s; }
            #sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
         @if(session('success'))
    <div style="background:#e6f4ea;color:#1a6b36;padding:10px 16px;border-radius:8px;margin-bottom:1rem;font-size:13px;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background:#fcebeb;color:#a32d2d;padding:10px 16px;border-radius:8px;margin-bottom:1rem;font-size:13px;">
        {{ session('error') }}
    </div>
@endif
    @stack("styles")
</head>
<body>

{{-- ── Sidebar ───────────────────────────────────────────── --}}
<div id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-calendar-week-fill"></i></div>
        <div class="brand-name">Class Schedule</div>
        <div class="brand-sub">Management System</div>
    </div>

    <div class="sidebar-section">Main</div>
    <div class="nav-item">
        <a href="{{ route("dashboard") }}" class="{{ request()->routeIs("dashboard") ? "active" : "" }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route("schedules.index") }}" class="{{ request()->routeIs("schedules.*") ? "active" : "" }}">
            <i class="bi bi-calendar3"></i> Class Schedules
        </a>
    </div>

    @if(auth()->check() && auth()->user()->role === "admin")
    <div class="sidebar-section">Admin</div>
    <div class="nav-item">
        <a href="{{ route("users.index") }}" class="{{ request()->routeIs("users.*") ? "active" : "" }}">
            <i class="bi bi-people-fill"></i> Users
        </a>
    </div>
    @endif

    <div class="sidebar-section">Account</div>
    <div class="nav-item">
        <a href="{{ route("profile.edit") }}"
           class="{{ request()->routeIs("profile.*") ? "active" : "" }}">
            <i class="bi bi-person-circle"></i> My Profile
        </a>
    </div>

    <div class="sidebar-footer">
        <a href="{{ route("profile.edit") }}" class="user-chip">
            <div class="user-avatar">
                @if(auth()->check() && auth()->user()->profile_picture)
                    <img src="{{ asset("storage/" . auth()->user()->profile_picture) }}" alt="">
                @else
                    {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : "" }}
                @endif
            </div>
            <div class="user-meta">
                {{-- ✅ Fixed: changed .user-name and .user-role to match CSS --}}
                <div class="user-name">{{ auth()->check() ? auth()->user()->name : "" }}</div>
                <div class="user-role">{{ ucfirst(auth()->user()->role ?? "User") }}</div>
            </div>
        </a>
    </div>
</div> {{-- ✅ Fixed: closing tag for #sidebar was missing --}}

{{-- ── Main Content ──────────────────────────────────────── --}}
<div class="main-content">
    <div class="topbar">
        <button class="btn btn-sm d-md-none me-2" onclick="document.getElementById("sidebar").classList.toggle("show")">
            <i class="bi bi-list fs-5"></i>
        </button>
        <span class="topbar-title">@yield("page-title", "Dashboard")</span>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted" style="font-size:12px">{{ now()->format("M d, Y") }}</span>
            <form method="POST" action="{{ route("logout") }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="page-content">
        @yield("content")
    </div>
</div>

{{-- ── Toast Notifications ───────────────────────────────── --}}
<div class="toast-container-fixed" id="toastBox"></div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showToast(type, message) {
    const icons = {
        success: "bi-check-circle-fill",
        info:    "bi-info-circle-fill",
        warning: "bi-exclamation-triangle-fill",
        danger:  "bi-x-circle-fill",
    };
    const colors = {
        success: "#16A34A", info: "#2563EB",
        warning: "#D97706", danger: "#DC2626",
    };
    const box = document.getElementById("toastBox");
    const el  = document.createElement("div");
    el.className = "toast show align-items-center border-0 shadow-sm";
    el.style.cssText = `border-radius:10px;min-width:260px;background:#fff;border-left:4px solid ${colors[type]}!important;`;
    el.innerHTML = `
        <div class="d-flex align-items-center gap-2 p-3">
            <i class="bi ${icons[type]}" style="color:${colors[type]};font-size:16px;flex-shrink:0"></i>
            <span style="font-size:13px;font-weight:500;flex:1">${message}</span>
            <button type="button" class="btn-close btn-close-sm ms-1" onclick="this.closest(".toast").remove()"></button>
        </div>`;
    box.appendChild(el);
    setTimeout(() => el.remove(), 3500);
}

// Auto-fire flash toasts from Laravel session
@if(session("toast_success"))
    showToast("success", @json(session("toast_success")));
@endif
@if(session("toast_info"))
    showToast("info", @json(session("toast_info")));
@endif
@if(session("toast_warning"))
    showToast("warning", @json(session("toast_warning")));
@endif
@if(session("toast_danger"))
    showToast("danger", @json(session("toast_danger")));
@endif
</script>

@stack("scripts")
</body>
</html>
