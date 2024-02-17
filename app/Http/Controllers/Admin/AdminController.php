<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // $userCount = User::count();

        $admins = Admin::all();

        return view('admin.index', compact('admins'));
    }
}
