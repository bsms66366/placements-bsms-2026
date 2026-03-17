<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportAttendancePDF extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Export Attendance Report (PDF)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $student = $models->first();
        
        if (!$student) {
            return Action::danger('No student selected.');
        }

        $sessionAttendance = $student->sessionAttendance()
            ->with('session')
            ->orderBy('session_date', 'desc')
            ->get();

        $locationSignoffs = $student->locationSignoffs()
            ->with('location')
            ->orderBy('created_at', 'desc')
            ->get();

        $examinationResults = $student->examinationResults()
            ->with('examination')
            ->orderBy('assessed_at', 'desc')
            ->get();

        $statistics = [
            'total_sessions' => $sessionAttendance->count(),
            'total_locations' => $locationSignoffs->count(),
            'total_examinations' => $examinationResults->count(),
            'competent_examinations' => $examinationResults->where('is_competent', true)->count(),
            'not_competent_examinations' => $examinationResults->where('is_competent', false)->count(),
        ];

        $pdf = PDF::loadView('pdf.attendance-report', [
            'student' => $student,
            'sessionAttendance' => $sessionAttendance,
            'locationSignoffs' => $locationSignoffs,
            'examinationResults' => $examinationResults,
            'statistics' => $statistics,
            'generated_at' => now()->format('d M Y, H:i'),
        ]);

        $filename = 'attendance-report-' . $student->user_id . '-' . now()->format('Y-m-d') . '.pdf';

        return Action::download(
            $pdf->output(),
            $filename
        );
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
