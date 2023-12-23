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
    // public function store(Request $request)
    // {

    //     $questionId = $request->input('question_id');
    //     $userId = $request->input('user_id');
    //     $user = User::findOrFail($userId);
    //     $question = Question::find($questionId);

    //     // dd($question->answer_options);
    //     // dd($user->id);

    //     $answer = new Answer(
    //         [
    //             'user_id' => $user->id,
    //             'question_id' => $questionId,
    //             'selected_option' => $request->input('selected_option')
    //         ],
    //     );
    //     $answer->save();

    //     return response()->json($answer, 200);
    // }
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

    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'user_id' => 'required',
    //     //     'question_id' => 'required|exists:questions,id',
    //     //     'selected_option' => 'required',
    //     // ]);

    //     // $user = Auth::user();

    //     $questionId = $request->input('question_id');
    //     $userId = $request->input('user_id');
    //     $user = User::findOrFail($userId);
    //     $question = Question::find($questionId);

    //     // dd($question->answer_options);
    //     // dd($user->id);

    //     $answer = new Answer(
    //         [
    //             'user_id' => $user->id,
    //             'question_id' => $questionId,
    //             'selected_option' => $request->input('selected_option')
    //         ],
    //     );
    //     $answer->save();

    //     // // Ambil pertanyaan dan opsi jawaban terkait
    //     // // $question = Question::find($request->input('question_id'));
    //     $optionSelected = $request->input('selected_option');

    //     // // Temukan opsi jawaban yang sesuai
    //     // $answerOptions = json_decode($question->answer_options, true);
    //     $answerOptions = $question->answer_options;

    //     // $answerOption = collect($answerOptions)->first(function ($option) use ($optionSelected) {
    //     //     return $option['option_value'] === $optionSelected;
    //     // });

    //     // if ($answerOption) {
    //     //     // Opsi jawaban ditemukan, lakukan sesuatu dengannya jika perlu
    //     // }

    //     return response()->json($answer, 200);

    //     // if ($question) {
    //     //     $answer = new Answer(
    //     //         [
    //     //             // 'user_id' => $user->id,
    //     //             'question_id' => $questionId,
    //     //         ],
    //     //         ['selected_option' => $request->input('selected_option')]
    //     //     );
    //     //     $answer->save();

    //     //     // Ambil pertanyaan dan opsi jawaban terkait
    //     //     $question = Question::find($request->input('question_id'));
    //     //     $selectedOption = $request->input('selected_option');

    //     //     // Temukan opsi jawaban yang sesuai
    //     //     $answerOptions = json_decode($question->answer_options, true);

    //     //     $answerOption = collect($answerOptions)->first(function ($option) use ($selectedOption) {
    //     //         return $option['option_value'] === $selectedOption;
    //     //     });

    //     //     if ($answerOption) {
    //     //         // Opsi jawaban ditemukan, lakukan sesuatu dengannya jika perlu
    //     //     }

    //     //     return response()->json($answer, 200);
    //     // } else {
    //     //     // Handle kasus ketika pertanyaan tidak ditemukan
    //     //     return response()->json(['error' => 'Question not found'], 404);
    //     // }
    // }

    public function getByQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $answers = $question->answer_options;

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
