<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AvatarMood;
use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotifMoodResult;
use App\Mail\NotifUserMoods;
use Illuminate\Support\Facades\Mail;

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
        // return view('admin.moods.create', ['userIdFromUrl' => $userId]);
        $avatarMoods = AvatarMood::all();

        // Tampilkan formulir pembuatan mood untuk user tertentu
        return view('admin.moods.create', ['userIdFromUrl' => $userId, 'avatarMoods' => $avatarMoods]);
    }

    public function store(Request $request)
    {
        // dd($request->input('mood'));
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'mood' => 'required',
            'avatar_moods' => 'required',
            'survey_date' => 'required',
        ]);

        $moods = Mood::create($request->all());

        // Mengambil alamat email user terkait
        $userEmail = $moods->user->email;

        $email = new NotifUserMoods($moods);
        // Mail::to('reonaldi1105@gmail.com')->send($email);
        Mail::to($userEmail)->send($email);

        return redirect('/admin/moods')->with('success', 'Mood berhasil dibuat!');
    }
}
