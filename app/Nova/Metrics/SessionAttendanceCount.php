<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use App\Models\Student;

class SessionAttendanceCount extends Value
{
    public function calculate(NovaRequest $request)
    {
        $studentId = $request->resourceId;
        
        if (!$studentId) {
            return $this->result(0);
        }

        $student = Student::find($studentId);
        
        if (!$student) {
            return $this->result(0);
        }

        $count = $student->sessionAttendance()->count();

        return $this->result($count)
            ->suffix('Sessions Attended')
            ->format('0,0');
    }

    public function ranges()
    {
        return [];
    }

    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return 'session-attendance-count';
    }

    public function name()
    {
        return 'Teaching Sessions';
    }
}
