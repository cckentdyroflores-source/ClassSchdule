<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $scheduleCount = $user->schedules()->count();
        return view('profile.index', compact('user', 'scheduleCount'));
    }

    // ✅ ADD THIS METHOD
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'contact' => 'nullable|string|max:20',
            'gender'  => 'nullable|string',
            'address' => 'nullable|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'contact', 'gender', 'address'));

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->update(['password' => Hash::make($request->password)]);
        }

        if ($request->hasFile('avatar')) {
            $request->validate(['avatar' => 'image|max:2048']);
            if ($user->avatar) Storage::disk('public')->delete($user->avatar);
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}