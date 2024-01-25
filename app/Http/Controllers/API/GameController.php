<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = game::all();
        // return response()->json($articles);
        return ResponseFormatter::success($games, "Berhasil mendapatkan data game");
    }
}
