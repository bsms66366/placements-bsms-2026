<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use App\Models\Student;

class LocationSignoffCount extends Value
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

        $count = $student->locationSignoffs()->count();

        return $this->result($count)
            ->suffix('Locations Signed Off')
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
        return 'location-signoff-count';
    }

    public function name()
    {
        return 'Placement Locations';
    }
}
