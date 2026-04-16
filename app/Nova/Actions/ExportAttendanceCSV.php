<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Services\AttendanceReportService;

class ExportAttendanceCSV extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Export Attendance Data (CSV)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $attendanceService = new AttendanceReportService();
        
        if ($models->isEmpty()) {
            return Action::danger('No students selected.');
        }

        $csvData = [];
        
        // Add header row
        $csvData[] = [
            'BSMS ID',
            'Name',
            'Student Number',
            'Year',
            'Email',
            'Total Sessions',
            'Total Locations',
            'Total Examinations',
            'Competent Examinations',
            'Not Competent Examinations',
        ];

        // Add data rows
        foreach ($models as $student) {
            $studentData = $attendanceService->getStudentWithAttendance($student->id);
            
            if ($studentData) {
                $csvData[] = [
                    $studentData->bsms_id ?? $studentData->user_id ?? '',
                    $studentData->name ?? '',
                    $studentData->student_number ?? '',
                    $studentData->year ?? '',
                    $studentData->email ?? '',
                    $studentData->attendance_stats['total_sessions'],
                    $studentData->attendance_stats['total_locations'],
                    $studentData->attendance_stats['total_examinations'],
                    $studentData->attendance_stats['competent_examinations'],
                    $studentData->attendance_stats['not_competent_examinations'],
                ];
            }
        }

        $filename = 'attendance-export-' . now()->format('Y-m-d-His') . '.csv';
        
        // Create CSV content
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= '"' . implode('","', $row) . '"' . "\n";
        }

        return Action::download($csvContent, $filename);
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
