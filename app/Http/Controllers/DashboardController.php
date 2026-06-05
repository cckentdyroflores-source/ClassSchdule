<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Metric counts ────────────────────────────────────────────
        $totalUsers     = User::count();
        $totalSchedules = Schedule::count();
        $totalSubjects  = Schedule::distinct('subject')->count('subject');
        $totalRooms     = Schedule::distinct('room')->count('room');

        // ── Recent schedules table ───────────────────────────────────
        $recentSchedules = Schedule::latest()->take(5)->get();

        // ── Chart 1: classes per day (1 query instead of 7) ─────────
        $days         = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
        $dayCounts    = Schedule::select('day', DB::raw('count(*) as total'))
                            ->groupBy('day')
                            ->pluck('total', 'day');   // keyed by day name

        $classesPerDay = collect($days)
                            ->map(fn($d) => (int) ($dayCounts[$d] ?? 0))
                            ->values()
                            ->toArray();

        // ── Chart 2: classes per subject (1 query instead of N) ──────
        $subjectData   = Schedule::select('subject', DB::raw('count(*) as total'))
                            ->groupBy('subject')
                            ->orderByDesc('total')
                            ->get();

        $subjectLabels = $subjectData->pluck('subject')->toArray();
        $subjectCounts = $subjectData->pluck('total')->map(fn($v) => (int) $v)->toArray();

        return view('dashboard', compact(
            'totalUsers',
            'totalSchedules',
            'totalSubjects',
            'totalRooms',
            'recentSchedules',
            'days',
            'classesPerDay',
            'subjectLabels',
            'subjectCounts'
        ));
    }
}