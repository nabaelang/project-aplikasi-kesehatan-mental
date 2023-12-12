<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

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
}
