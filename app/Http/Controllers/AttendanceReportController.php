<?php

namespace App\Http\Controllers;

use App\Services\AttendanceReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceReportController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceReportService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    /**
     * Get all students with attendance data
     */
    public function getAllStudents(Request $request)
    {
        $filters = $this->buildFilters($request);
        $students = $this->attendanceService->getAllStudentsWithAttendance($filters);

        return response()->json([
            'students' => $students,
            'count' => $students->count(),
        ]);
    }

    /**
     * Get filtered students with attendance
     */
    public function filterStudents(Request $request)
    {
        $filters = $this->buildFilters($request);
        $students = $this->attendanceService->getAllStudentsWithAttendance($filters);

        return response()->json([
            'students' => $students,
            'count' => $students->count(),
        ]);
    }

    /**
     * Get overall statistics
     */
    public function getStatistics(Request $request)
    {
        $filters = $this->buildFilters($request);
        $statistics = $this->attendanceService->getOverallStatistics($filters);

        return response()->json($statistics);
    }

    /**
     * Get filter options
     */
    public function getFilterOptions()
    {
        $options = $this->attendanceService->getFilterOptions();

        return response()->json($options);
    }

    /**
     * Get single student with attendance
     */
    public function getStudent(Request $request, $id)
    {
        $filters = $this->buildFilters($request);
        $student = $this->attendanceService->getStudentWithAttendance($id, $filters);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    /**
     * Export cohort attendance as PDF
     */
    public function exportCohortPDF(Request $request)
    {
        $validated = $request->validate([
            'detail_level' => 'in:summary,detailed,comparison',
            'filters' => 'array',
        ]);

        $filters = $validated['filters'] ?? [];
        $detailLevel = $validated['detail_level'] ?? 'summary';

        $students = $this->attendanceService->getAllStudentsWithAttendance($filters);
        $statistics = $this->attendanceService->getOverallStatistics($filters);

        $pdf = PDF::loadView('pdf.cohort-attendance-report', [
            'students' => $students,
            'statistics' => $statistics,
            'detail_level' => $detailLevel,
            'filters' => $filters,
            'generated_at' => now()->format('d M Y, H:i'),
        ]);

        $filename = 'cohort-attendance-report-' . now()->format('Y-m-d-His') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export attendance data as CSV
     */
    public function exportCSV(Request $request)
    {
        $filters = $this->buildFilters($request);
        $csvData = $this->attendanceService->prepareCSVData($filters);

        $filename = 'attendance-export-' . now()->format('Y-m-d-His') . '.csv';

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Build filters array from request
     */
    protected function buildFilters(Request $request)
    {
        $filters = [];

        if ($request->has('year')) {
            $filters['year'] = $request->input('year');
        }

        if ($request->has('modules')) {
            $filters['modules'] = $request->input('modules');
        }

        if ($request->has('clinical_subtypes')) {
            $filters['clinical_subtypes'] = $request->input('clinical_subtypes');
        }

        if ($request->has('date_from')) {
            $filters['date_from'] = $request->input('date_from');
        }

        if ($request->has('date_to')) {
            $filters['date_to'] = $request->input('date_to');
        }

        if ($request->has('min_sessions')) {
            $filters['min_sessions'] = (int) $request->input('min_sessions');
        }

        if ($request->has('max_sessions')) {
            $filters['max_sessions'] = (int) $request->input('max_sessions');
        }

        if ($request->has('min_locations')) {
            $filters['min_locations'] = (int) $request->input('min_locations');
        }

        if ($request->has('max_locations')) {
            $filters['max_locations'] = (int) $request->input('max_locations');
        }

        return $filters;
    }
}
