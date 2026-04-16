<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\AttendanceReportService;

class ExportCohortAttendancePDF extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Export Cohort Attendance Report (PDF)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $attendanceService = new AttendanceReportService();
        
        $detailLevel = $fields->detail_level ?? 'summary';
        
        // Get all students with their attendance data
        $students = $models->map(function ($student) use ($attendanceService) {
            return $attendanceService->getStudentWithAttendance($student->id);
        })->filter();

        if ($students->isEmpty()) {
            return Action::danger('No students selected.');
        }

        // Calculate statistics for the cohort
        $statistics = [
            'total_students' => $students->count(),
            'total_sessions_recorded' => $students->sum(fn($s) => $s->attendance_stats['total_sessions']),
            'total_locations_visited' => $students->sum(fn($s) => $s->attendance_stats['total_locations']),
            'total_examinations' => $students->sum(fn($s) => $s->attendance_stats['total_examinations']),
            'total_competent' => $students->sum(fn($s) => $s->attendance_stats['competent_examinations']),
            'average_sessions_per_student' => $students->count() > 0 
                ? round($students->avg(fn($s) => $s->attendance_stats['total_sessions']), 2) 
                : 0,
            'average_locations_per_student' => $students->count() > 0 
                ? round($students->avg(fn($s) => $s->attendance_stats['total_locations']), 2) 
                : 0,
        ];

        $pdf = PDF::loadView('pdf.cohort-attendance-report', [
            'students' => $students,
            'statistics' => $statistics,
            'detail_level' => $detailLevel,
            'generated_at' => now()->format('d M Y, H:i'),
        ]);

        $filename = 'cohort-attendance-report-' . now()->format('Y-m-d-His') . '.pdf';

        return Action::download(
            $pdf->output(),
            $filename
        );
    }

    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Detail Level', 'detail_level')
                ->options([
                    'summary' => 'Summary Only (Quick Overview)',
                    'detailed' => 'Detailed (Full Report per Student)',
                    'comparison' => 'Comparison Table (All Students)',
                ])
                ->default('summary')
                ->help('Choose the level of detail for the PDF report'),
        ];
    }
}
