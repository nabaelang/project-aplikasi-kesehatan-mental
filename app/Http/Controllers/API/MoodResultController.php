<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Mail\NotifMoodResult;
use App\Models\Mood;
use App\Models\MoodRange;
use App\Models\MoodResult;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MoodResultController extends Controller
{
    // public function store(Request $request)
    // {
    //     $userId = $request->input('user_id');
    //     $user = User::findOrFail($userId);

    //     // $request->validate([
    //     //     'user_mood' => 'nullable|array',
    //     // ]);

    //     $avg = [];
    //     // dd($request->user_mood);
    //     foreach ((array) $request->user_mood as $item) {
    //         $avg[] = array_sum($item) / count($item);
    //     }
    //     dd($avg);

    //     $moodResult = new MoodResult([
    //         'user_id' => $user->id,
    //         // 'user_mood' => $this->parseUserMood($request->input('user_mood')),
    //         'user_mood' => json_encode($request->input('user_mood')),
    //     ]);
    //     $moodResult->save();

    //     $email = new NotifMoodResult($moodResult);
    //     Mail::to('reonaldi1105@gmail.com')->send($email);

    //     // return response()->json(['message' => 'data successfully', 'data' => $moodResult], 200);
    //     return ResponseFormatter::success($moodResult, "Success");
    // }

    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);

        $request->validate([
            'user_mood' => 'nullable|string',
        ]);

        $userMoodJson = $request->input('user_mood');
        $userMoodArray = json_decode($userMoodJson, true);

        if (is_array($userMoodArray)) {
            $averageMood = count($userMoodArray) > 0 ? round(array_sum($userMoodArray) / count($userMoodArray)) : null;
            $intAvg = (int) $averageMood;

            // dd($intAvg);

            // Mengambil mood configurations yang sesuai dengan range
            $moodRanges = MoodRange::all();

            // Inisialisasi mood_status, female_avatar, dan male_avatar
            $moodStatus = 'Unknown';
            $femaleAvatar = 'Unknown';
            $maleAvatar = 'Unknown';

            // Menentukan mood_status, female_avatar, dan male_avatar berdasarkan range
            foreach ($moodRanges as $moodRange) {
                if ($intAvg >= $moodRange->min_range && $intAvg <= $moodRange->max_range) {
                    $moodStatus = $moodRange->mood_status;
                    $femaleAvatar = $moodRange->female_avatar;
                    $maleAvatar = $moodRange->male_avatar;
                    break;
                }
            }

            $moodResult = new MoodResult([
                'user_id' => $user->id,
                'user_mood' => $moodStatus,
                'mood_status' => $moodStatus,
                'female_avatar' => $femaleAvatar,
                'male_avatar' => $maleAvatar,
            ]);
            $moodResult->save();

            $mood = new Mood([
                'user_id' => $moodResult->user_id,
                'mood' => $moodResult->mood_status,
                'avatar_moods' => $user->gender === 'female' ? $femaleAvatar : $maleAvatar,
                'survey_date' => now(), // Anda dapat menyesuaikan ini sesuai kebutuhan
            ]);
            $mood->save();

            return ResponseFormatter::success($moodResult, "Success");
        } else {
            return ResponseFormatter::error(null, 'Invalid user_mood format', 422);
        }
    }




    function calculateAverage($dataArray)
    {
        // Create a collection from the array
        $collection = collect($dataArray);
        // dd($dataArray);

        // Check if the collection is not empty to avoid division by zero
        if ($collection->isEmpty()) {
            return 0;
        }

        // Calculate the average
        $average = $collection->average();

        return $average;
    }

    private function parseUserMood($options)
    {
        // return $options ? explode(',', $options) : null;
        return implode(',', $options);
    }

    public function averageUserMood(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $moodResult = MoodResult::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
    }
}
