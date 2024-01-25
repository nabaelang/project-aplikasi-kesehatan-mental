<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = article::all();
        // return response()->json($articles);
        return ResponseFormatter::success($articles, "Berhasil mendapatkan data artikel");
    }
}
