<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\MoodConfiguration;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option' => 'required',
        ]);

        $user = $request->user();

        $answer = Answer::updateOrCreate(
            ['user_id' => $user->id, 'question_id' => $request->input('question_id')],
            ['selected_option' => $request->input('selected_option')]
        );

        return response()->json(['message' => 'Answer submitted successfully']);
    }

    public function getByQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $answers = $question->answers;

        return response()->json($answers);
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

    private function detectMood($user, $questionId, $selectedOption)
    {
        return MoodConfiguration::getMood($questionId, $selectedOption);
    }
}
