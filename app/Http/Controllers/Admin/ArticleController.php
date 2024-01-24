<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = article::all();
        return view('admin.article.index', compact('articles'));
    }

    public function show(article $article)
    {
        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.article.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Article created successfully');
    }

    public function edit(article $article)
    {
        return view('admin.article.edit', compact('article'));
    }

    public function update(Request $request, article $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
            // tambahkan validasi jika ada pilihan jawaban
        ]);

        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('admin.article.index')->with('success', 'Article updated successfully');
    }

    public function destroy(article $article)
    {
        $article->delete();

        return redirect()->route('admin.article.index')->with('success', 'Article deleted successfully');
    }
}
