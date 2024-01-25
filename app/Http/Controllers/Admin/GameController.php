<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\game;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GameController extends Controller
{
    public function index()
    {
        $games = game::all();
        return view('admin.game.index', compact('games'));
    }

    public function create()
    {
        return view('admin.game.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'link' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = $request->file('image')->store('games', 'public');

            Game::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'link' => $request->input('link'),
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.game.index')->with('success', 'Game created successfully');
        } catch (\Exception $e) {
            // Tangkap kesalahan umum dan tampilkan pesan kesalahan
            dd($e->getMessage());
        }
    }

    public function edit(game $game)
    {
        return view('admin.game.edit', compact('game'));
    }


    public function update(Request $request, $id)
    {
        $game = game::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // tambahkan validasi jika ada pilihan jawaban
        ]);

        if ($request->hasFile('image')) {
            // Handle image upload
            $imagePath = $request->file('image')->store('avatars', 'public');
            $game->update(['image' => $imagePath]);
        }

        $game->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('admin.game.index')->with('success', 'Game updated successfully');
    }

    public function destroy($id)
    {
        $game = game::findOrFail($id);
        $game->delete();

        return redirect()->route('admin.game.index')->with('success', 'Game deleted successfully');
    }
}
