<?php

namespace App\Http\Controllers;

use App\Jobs\SaveSessionJob;
use App\Models\SessionAttendance2026;
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

       SaveSessionJob::dispatch($validated);

        return response()->json([
            'status' => 'queued'
        ]);
    }

    public function saveSession(Request $request)
    {
        return $this->store($request);
    }
}
