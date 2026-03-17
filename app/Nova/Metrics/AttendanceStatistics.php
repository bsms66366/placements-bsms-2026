<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use App\Models\Student;

class AttendanceStatistics extends Value
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

        $sessionCount = $student->sessionAttendance()->count();
        $locationCount = $student->locationSignoffs()->count();
        $examinationCount = $student->examinationResults()->count();
        $competentCount = $student->examinationResults()->where('is_competent', true)->count();

        $total = $sessionCount + $locationCount + $examinationCount;

        return $this->result($total)
            ->suffix('Total Records')
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
        return 'attendance-statistics';
    }

    public function name()
    {
        return 'Total Attendance Records';
    }
}
