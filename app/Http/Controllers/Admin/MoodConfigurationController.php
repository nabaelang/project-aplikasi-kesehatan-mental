<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoodConfiguration;
use App\Models\Question;
use Illuminate\Http\Request;

class MoodConfigurationController extends Controller
{
    public function index()
    {
        $moodConfigurations = MoodConfiguration::with('question')->get();
        $questions = Question::all();

        return view('admin.mood_configurations.index', compact('moodConfigurations', 'questions'));
    }

    public function create()
    {
        $questions = Question::all();

        return view('admin.mood_configurations.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option' => 'required',
            'mood' => 'required',
            'percentage' => 'required|numeric',
        ]);

        MoodConfiguration::create($request->all());

        return redirect()->route('admin.mood_configurations.index')->with('success', 'Mood configuration created successfully');
    }

    public function edit(MoodConfiguration $moodConfiguration)
    {
        // $moodConfig = MoodConfiguration::find($moodConfiguration);
        $questions = Question::all();
        $answerOptions = $this->getAnswerOptions($moodConfiguration->question_id); // Anda perlu membuat metode ini

        return view('admin.mood_configurations.edit', compact('moodConfiguration', 'questions', 'answerOptions'));
    }

    protected function getAnswerOptions($questionId)
    {
        $question = Question::find($questionId);
        return $question ? $question->answer_options : [];
    }

    public function update(Request $request, MoodConfiguration $moodConfiguration)
    {
        // $request->validate([
        //     'question_id' => 'required|exists:questions,id',
        //     'selected_option' => 'required',
        //     'mood' => 'required',
        // ]);

        $moodConfiguration->update($request->all());

        return redirect()->route('admin.mood_configurations.index')->with('success', 'Mood configuration updated successfully');
    }

    public function destroy(MoodConfiguration $moodConfiguration)
    {
        $moodConfiguration->delete();

        return redirect()->route('admin.mood_configurations.index')->with('success', 'Mood configuration deleted successfully');
    }

    public function loadAnswers($questionId)
    {
        $question = Question::findOrFail($questionId);
        $answerOptions = $question->answer_options;

        // dd($answerOptions);

        return view('admin.mood_configurations.answer_options', compact('answerOptions'));
    }

    public function show($id)
    {
        $moodConfiguration = MoodConfiguration::findOrFail($id);

        return view('admin.mood_configurations.index', compact('moodConfiguration'));
    }
}
