<?php

namespace App\Http\Controllers;

use App\Jobs\SaveSessionJob;
use App\Models\SessionAttendance2026;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;



class SessionAttendanceController extends Controller
{
    public function index()
    {
        return SessionAttendance2026::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bsms_id' => 'required|string|max:255',
            'session_date' => 'required|date',
            'session_id' => 'required|exists:MonitoredSessions2026,ID',
        ]);

        $alreadyExists = SessionAttendance2026::where('session_id', $validated['session_id'])
            ->where('bsms_id', $validated['bsms_id'])
            ->exists();

        if ($alreadyExists) {
            return response()->json([
                'message' => 'Attendance already recorded for this session.',
            ], 422);
        }

        try {
            SaveSessionJob::dispatch($validated);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Attendance already recorded for this session.',
            ], 422);
        }

        return response()->json([
            'status' => 'queued'
        ]);
    }

    public function saveSession(Request $request)
    {
        return $this->store($request);
    }
}
