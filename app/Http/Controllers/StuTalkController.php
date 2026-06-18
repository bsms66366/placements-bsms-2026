<?php

namespace App\Http\Controllers;

use App\Services\StuTalkService;
use App\Transformers\StudentProfileTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StuTalkController extends Controller
{
    public function __construct(protected StuTalkService $stuTalk) {}

    public function getStudentProfile(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string',
        ]);

        try {
            $raw     = $this->stuTalk->getStudentProfile($request->input('student_number'));
            $profile = StudentProfileTransformer::transform($raw);

            return response()->json($profile);
        } catch (\RuntimeException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('StuTalk exception', ['message' => $e->getMessage()]);

            return response()->json(['error' => 'Error connecting to SITS'], 500);
        }
    }
}
