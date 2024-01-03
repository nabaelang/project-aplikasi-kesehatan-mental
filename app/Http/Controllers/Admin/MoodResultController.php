<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoodResult;
use Illuminate\Http\Request;

class MoodResultController extends Controller
{
    public function index()
    {
        $moodResults = MoodResult::with('user')->get();

        return view('admin.mood-results.index', compact('moodResults'));
    }

    public function determineMood(Request $request, $id)
    {
        $moodResult = MoodResult::findOrFail($id);
        // Lakukan logika untuk menentukan mood berdasarkan user_mood di $moodResult

        return redirect()->route('admin.mood-results.index')->with('success', 'Mood determined successfully');
    }
}
