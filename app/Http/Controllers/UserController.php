<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule; // ✅ FIX: required import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, fn($q) =>
            $q->where('name', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%')
        )->latest()->get();

        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        return back()->with('success', 'User added successfully!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return back()->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted.');
    }

   public function schedule(Request $request)
{
    $request->validate([
        'subject' => 'required',
        'day' => 'required',
        'room' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'instructor' => 'required',
    ]);

    Schedule::create([
        'user_id' => auth()->id(),
        'subject' => $request->subject,
        'day' => $request->day,
        'room' => $request->room,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'instructor' => $request->instructor,
    ]);

    return back()->with('success', 'Schedule created successfully!');
}
}