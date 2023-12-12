<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'survey_date' => 'required|date',
            'answer_options' => 'nullable|string',
        ]);

        $question = Question::create([
            'question' => $request->input('question'),
            'survey_date' => $request->input('survey_date'),
            'answer_options' => $this->parseAnswerOptions($request->input('answer_options')),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully');
    }

    // Fungsi untuk mengubah string opsi jawaban menjadi array
    private function parseAnswerOptions($options)
    {
        return $options ? explode(',', $options) : null;
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'survey_date' => 'required|date',
            // tambahkan validasi jika ada pilihan jawaban
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully');
    }
}
