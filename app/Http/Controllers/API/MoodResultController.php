<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Mail\NotifMoodResult;
use App\Models\MoodResult;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MoodResultController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);

        // $request->validate([
        //     'user_mood' => 'nullable|array',
        // ]);

        $moodResult = new MoodResult([
            'user_id' => $user->id,
            // 'user_mood' => $this->parseUserMood($request->input('user_mood')),
            'user_mood' => $request->input('user_mood'),
        ]);
        $moodResult->save();

        $email = new NotifMoodResult($moodResult);
        Mail::to('reonaldi1105@gmail.com')->send($email);

        // return response()->json(['message' => 'data successfully', 'data' => $moodResult], 200);
        return ResponseFormatter::success($moodResult, "Success");
    }

    private function parseUserMood($options)
    {
        // return $options ? explode(',', $options) : null;
        return implode(',', $options);
    }
}
