<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    private array $colors = [
        '#4f7cff', '#22d3a5', '#f87171', '#fbbf24',
        '#a78bfa', '#34d399', '#fb923c', '#f472b6',
    ];

    public function index(Request $request)
    {
        $schedules = Schedule::when($request->search, fn($q) =>
            $q->where('subject', 'like', '%'.$request->search.'%')
              ->orWhere('instructor', 'like', '%'.$request->search.'%')
              ->orWhere('room', 'like', '%'.$request->search.'%')
        )
        ->when($request->day, fn($q) => $q->where('day', $request->day))
        ->latest()->get();

        return view('schedules.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'    => 'required|string|max:255',
            'day'        => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'room'       => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
        ]);

        Schedule::create([
            'user_id'    => Auth::id(),
            'subject'    => $request->subject,
            'day'        => $request->day,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'room'       => $request->room,
            'instructor' => $request->instructor,
            'color'      => $this->colors[Schedule::count() % count($this->colors)],
        ]);

        return back()->with('success', 'Schedule added!');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'subject'    => 'required|string|max:255',
            'day'        => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'room'       => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
        ]);

        $schedule->update($request->only('subject', 'day', 'start_time', 'end_time', 'room', 'instructor'));

        return back()->with('success', 'Schedule updated!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('success', 'Schedule deleted.');
    }
}