<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\MoodConfiguration;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $questionId = $request->input('question_id');
        $userId = $request->input('user_id');
        $selectedOption = $request->input('selected_option');

        $user = User::findOrFail($userId);
        $question = Question::find($questionId);

        $moodConfiguration = MoodConfiguration::where('question_id', $questionId)
            ->where('selected_option', $selectedOption)
            ->first();

        if ($moodConfiguration) {

            $answer = new Answer([
                'user_id' => $user->id,
                'question_id' => $questionId,
                'selected_option' => $selectedOption,
            ]);
            $answer->save();

            $mood = $moodConfiguration->mood;

            return response()->json(['message' => 'Answer submitted successfully', 'mood' => $mood], 200);
        } else {

            return response()->json(['error' => 'Mood configuration not found'], 404);
        }
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.selected_option' => 'required',
        ]);

        $user = $request->user();

        foreach ($request->input('answers') as $answerData) {
            Answer::updateOrCreate(
                ['user_id' => $user->id, 'question_id' => $answerData['question_id']],
                ['selected_option' => $answerData['selected_option']]
            );
        }

        return response()->json(['message' => 'Answers submitted successfully']);
    }

    public function getByQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $answers = $question->answer_options;

        return response()->json($answers);
    }

    private function detectMood($user, $questionId, $selectedOption)
    {
        return MoodConfiguration::getMood($questionId, $selectedOption);
    }
}
