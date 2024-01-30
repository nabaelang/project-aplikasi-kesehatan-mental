<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
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
        // return response()->json($moods);
        return ResponseFormatter::success($moods, "Success");
    }

    public function store(Request $request)
    {
        // Pastikan question_id sesuai dengan pertanyaan pada hari tersebut
        $mood = Mood::create($request->all());

        // $response = [
        //     'code' => 201,
        //     'status' => 'success',
        //     'message' => 'Berhasil menyimpan data mood',
        //     'data' => [
        //         'id' => $mood->id,
        //         'title' => $mood->title,
        //         'description' => $mood->description,
        //         'link' => $mood->link,
        //         'created_at' => $mood->created_at,
        //         'updated_at' => $mood->updated_at,
        //     ],
        // ];

        $response = [
            'code' => 201,
            'status' => 'success',
            'message' => 'Berhasil menyimpan data mood',
            'data' => $mood,
        ];

        return response()->json($response, 201);
    }


    public function getQuestionsByDate($date)
    {
        $questions = Question::where('survey_date', $date)->get();
        $questionsAll = Question::where('is_default', 'yes')->get();

        if ($questions->isEmpty()) {
            // return response()->json($questionsAll);
            return ResponseFormatter::success($questionsAll, "Success");
        }
        // return response()->json($questions);
        return ResponseFormatter::success($questions, "Success");
    }

    public function storeQuestion(Request $request)
    {
        $question = Question::create($request->all());
        // return response()->json($question, 201);
        $response = [
            'code' => 201,
            'status' => 'success',
            'message' => 'Berhasil menyimpan data question',
            'data' => $question,
        ];

        return response()->json($response, 201);
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

        // return response()->json($mood, 201);
        $response = [
            'code' => 201,
            'status' => 'success',
            'message' => 'Berhasil menyimpan data',
            'data' => $mood,
        ];

        return response()->json($response, 201);
    }

    public function getUserDailyMood($userId, $date)
    {
        $user = User::findOrFail($userId);
        $dailyMood = $user->moods()->where('survey_date', $date)->get();

        // return response()->json($dailyMood);
        return ResponseFormatter::success($dailyMood, "Success");
    }
    public function getUserMoodHistory($userId)
    {
        $user = User::findOrFail($userId);
        $moodHistory = $user->moods()->with('question')->get();

        // return response()->json($moodHistory);
        return ResponseFormatter::success($moodHistory, "Success");
    }
}
