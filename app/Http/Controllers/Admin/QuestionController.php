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
        // dd($request->all());
        $request->validate([
            'question' => 'required',
            'is_default' => 'required',
            'is_emoticon' => 'required',
            'survey_date' => 'nullable|date',
            'answer_options' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $imagePath = $request->file('image')->store('questions', 'public');


        Question::create([
            'question' => $request->input('question'),
            'is_default' => $request->input('is_default'),
            'is_emoticon' => $request->input('is_emoticon'),
            // 'image' => $imagePath,
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
        // $request->validate([
        //     'question' => 'required',
        //     'answer_options' => 'required',
        //     'survey_date' => 'nullable|date',
        //     'is_default' => 'required'
        //     // tambahkan validasi jika ada pilihan jawaban
        // ]);

        $question->update([
            'question' => $request->input('question'),
            'survey_date' => $request->input('survey_date'),
            'answer_options' => $this->parseAnswerOptions($request->input('answer_options')),
            'is_default' => $request->input('is_default'),
            'is_emoticon' => $request->input('is_emoticon'),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully');
    }
}
