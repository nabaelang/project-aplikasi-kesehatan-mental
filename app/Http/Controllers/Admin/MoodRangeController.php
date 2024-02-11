<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvatarMood;
use App\Models\MoodRange;
use Illuminate\Http\Request;

class MoodRangeController extends Controller
{
    public function index()
    {
        $moodRanges = MoodRange::all();
        return view('admin.mood_range.index', compact('moodRanges'));
    }

    public function show(moodRange $moodRange)
    {
        return view('admin.mood_range.index', compact('moodRange'));
    }

    public function create()
    {
        $avatarMoods = AvatarMood::all();

        return view('admin.mood_range.create', compact('avatarMoods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_range' => 'required',
            'max_range' => 'required',
            'mood_status' => 'required',
            'avatar_moods' => 'required',

        ]);

        MoodRange::create([
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'mood_status' => $request->mood_status,
            'avatar_moods' => $request->avatar_moods,
        ]);

        return redirect()->route('admin.mood_range.index')->with('success', 'Article created successfully');
    }

    public function edit(moodRange $moodRange)
    {
        return view('admin.mood_range.edit', compact('moodRange'));
    }

    public function update(Request $request, moodRange $moodRange)
    {

        $moodRange->update([
            'min_range' => $request->min_range,
            'max_range' => $request->max_range,
            'mood_status' => $request->mood_status,
            'avatar_moods' => $request->avatar_moods,
        ]);

        return redirect()->route('admin.mood_range.index')->with('success', 'Mood Range updated successfully');
    }

    public function destroy(moodRange $moodRange)
    {
        $moodRange->delete();

        return redirect()->route('admin.mood_range.index')->with('success', 'Mood Range deleted successfully');
    }
}
