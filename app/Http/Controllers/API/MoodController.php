<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mood;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Mood::with('question')->get();
        return response()->json($moods);
    }

    public function store(Request $request)
    {
        // Pastikan question_id sesuai dengan pertanyaan pada hari tersebut
        $mood = Mood::create($request->all());
        return response()->json($mood, 201);
    }

    public function getQuestionsByDate($date)
    {
        $questions = Question::where('survey_date', $date)->get();
        return response()->json($questions);
    }

    public function storeQuestion(Request $request)
    {
        $question = Question::create($request->all());
        return response()->json($question, 201);
    }

    public function trackMood(Request $request)
    {
        $user = Auth::user();
        $mood = new Mood([
            'user_id' => $user->id,
            'mood' => $request->input('mood'),
            'survey_date' => now()->toDateString(),
        ]);
        $mood->save();

        return response()->json($mood, 201);
    }

    public function getUserDailyMood($userId, $date)
    {
        $user = User::findOrFail($userId);
        $dailyMood = $user->moods()->where('survey_date', $date)->get();

        return response()->json($dailyMood);
    }
    public function getUserMoodHistory($userId)
    {
        $user = User::findOrFail($userId);
        $moodHistory = $user->moods()->with('question')->get();

        return response()->json($moodHistory);
    }
}
