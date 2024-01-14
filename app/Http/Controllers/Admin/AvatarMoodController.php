<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvatarMood;
use Illuminate\Http\Request;

class AvatarMoodController extends Controller
{
    public function index()
    {
        $avatarMoods = AvatarMood::all();
        return view('admin.avatar-moods.index', compact('avatarMoods'));
    }

    public function create()
    {
        return view('admin.avatar-moods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|in:male,female',
        ]);

        $imagePath = $request->file('image')->store('avatars', 'public');

        AvatarMood::create([
            'image' => $imagePath,
            // 'gender' => $request->input('gender'),
            'gender' => $request->input('gender') === 'male' ? 'L' : 'P',
        ]);

        return redirect('/admin/avatar-moods')->with('success', 'Avatar added successfully');
    }

    public function edit($id)
    {
        $avatarMood = AvatarMood::findOrFail($id);
        return view('admin.avatar-moods.edit', compact('avatarMood'));
    }

    public function update(Request $request, $id)
    {
        $avatarMood = AvatarMood::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required|in:male,female',
        ]);

        if ($request->hasFile('image')) {
            // Handle image upload
            $imagePath = $request->file('image')->store('avatars', 'public');
            $avatarMood->update(['image' => $imagePath]);
        }

        $avatarMood->update([
            'gender' => $request->input('gender'),
        ]);

        return redirect()->route('admin.avatar-moods.index')->with('success', 'Avatar updated successfully');
    }

    public function destroy($id)
    {
        $avatarMood = AvatarMood::findOrFail($id);
        $avatarMood->delete();

        return redirect('/admin/avatar-moods')->with('success', 'Avatar deleted successfully');
    }
}
