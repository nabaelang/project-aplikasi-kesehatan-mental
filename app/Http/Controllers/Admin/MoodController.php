<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Mood::with('user')->get();
        return view('admin.moods.index', compact('moods'));
    }

    public function edit($id)
    {
        $mood = Mood::findOrFail($id);
        // Sesuaikan dengan struktur model dan view yang Anda gunakan
        return view('admin.moods.edit', compact('mood'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mood' => 'required|string',
        ]);

        $mood = Mood::findOrFail($id);
        $mood->update([
            'mood' => $request->input('mood'),
            // Sesuaikan dengan atribut lain yang mungkin Anda miliki di tabel moods
        ]);

        return redirect('/admin/moods')->with('success', 'Mood updated successfully');
    }

    public function create($userId)
    {
        // Tampilkan formulir pembuatan mood untuk user tertentu
        return view('admin.moods.create', ['userIdFromUrl' => $userId]);
    }

    public function store(Request $request)
    {
        // dd($request->input('mood'));
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mood' => 'required',
            'survey_date' => 'required',
        ]);

        Mood::create($request->all());

        return redirect('/admin/moods')->with('success', 'Mood berhasil dibuat!');
    }
}
