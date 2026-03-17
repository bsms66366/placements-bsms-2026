<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\Student;

class ExaminationCompetency extends Partition
{
    public function calculate(NovaRequest $request)
    {
        $studentId = $request->resourceId;
        
        if (!$studentId) {
            return $this->result([]);
        }

        $student = Student::find($studentId);
        
        if (!$student) {
            return $this->result([]);
        }

        $competent = $student->examinationResults()->where('is_competent', true)->count();
        $notCompetent = $student->examinationResults()->where('is_competent', false)->count();

        return $this->result([
            'Competent' => $competent,
            'Not Yet Competent' => $notCompetent,
        ])->colors([
            'Competent' => '#10b981',
            'Not Yet Competent' => '#6b7280',
        ]);
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
        return 'examination-competency';
    }

    public function name()
    {
        return 'Clinical Examination Results';
    }
}
