<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = article::all();
        return response()->json($articles);
    }
}
