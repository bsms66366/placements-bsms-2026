<?php

namespace App\Services;

use App\Models\Student;
use App\Models\SessionAttendance2026;
use App\Models\LocationSignoff;
use App\Models\ExaminationResult;
use App\Models\MonitoredSessions2026;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AttendanceReportService
{
    /**
     * Get all students with their attendance counts
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudentsWithAttendance(array $filters = [])
    {
        $query = Student::query();

        // Apply year filter
        if (!empty($filters['year'])) {
            $query->where('year', $filters['year']);
        }

        // Apply attendance threshold filters later after getting counts
        $students = $query->with([
            'sessionAttendance' => function ($q) use ($filters) {
                $this->applySessionFilters($q, $filters);
            },
            'sessionAttendance.session',
            'locationSignoffs' => function ($q) use ($filters) {
                $this->applyDateRangeFilter($q, $filters, 'created_at');
            },
            'locationSignoffs.location',
            'examinationResults' => function ($q) use ($filters) {
                $this->applyDateRangeFilter($q, $filters, 'assessed_at');
            },
            'examinationResults.examination'
        ])->get();

        // Add computed statistics to each student
        $students->each(function ($student) {
            $student->attendance_stats = [
                'total_sessions' => $student->sessionAttendance->count(),
                'total_locations' => $student->locationSignoffs->count(),
                'total_examinations' => $student->examinationResults->count(),
                'competent_examinations' => $student->examinationResults->where('is_competent', true)->count(),
                'not_competent_examinations' => $student->examinationResults->where('is_competent', false)->count(),
            ];
        });

        // Apply threshold filters
        if (!empty($filters['min_sessions'])) {
            $students = $students->filter(function ($student) use ($filters) {
                return $student->attendance_stats['total_sessions'] >= $filters['min_sessions'];
            });
        }

        if (!empty($filters['max_sessions'])) {
            $students = $students->filter(function ($student) use ($filters) {
                return $student->attendance_stats['total_sessions'] <= $filters['max_sessions'];
            });
        }

        if (!empty($filters['min_locations'])) {
            $students = $students->filter(function ($student) use ($filters) {
                return $student->attendance_stats['total_locations'] >= $filters['min_locations'];
            });
        }

        if (!empty($filters['max_locations'])) {
            $students = $students->filter(function ($student) use ($filters) {
                return $student->attendance_stats['total_locations'] <= $filters['max_locations'];
            });
        }

        return $students->values();
    }

    /**
     * Apply session-specific filters
     */
    protected function applySessionFilters($query, array $filters)
    {
        // Apply module filter
        if (!empty($filters['modules'])) {
            $query->whereHas('session', function ($q) use ($filters) {
                $q->whereIn('ModuleCode', $filters['modules']);
            });
        }

        // Apply clinical subtype filter
        if (!empty($filters['clinical_subtypes'])) {
            $query->whereHas('session', function ($q) use ($filters) {
                $q->whereIn('ClinicalSubType', $filters['clinical_subtypes']);
            });
        }

        // Apply date range filter
        $this->applyDateRangeFilter($query, $filters, 'session_date');

        return $query;
    }

    /**
     * Apply date range filter to a query
     */
    protected function applyDateRangeFilter($query, array $filters, string $dateColumn)
    {
        if (!empty($filters['date_from'])) {
            $query->where($dateColumn, '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where($dateColumn, '<=', $filters['date_to']);
        }

        return $query;
    }

    /**
     * Get overall statistics for all students
     *
     * @param array $filters
     * @return array
     */
    public function getOverallStatistics(array $filters = [])
    {
        $students = $this->getAllStudentsWithAttendance($filters);

        return [
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
    }

    /**
     * Get available filter options
     *
     * @return array
     */
    public function getFilterOptions()
    {
        return Cache::remember('attendance_filter_options', 3600, function () {
            return [
                'years' => Student::distinct()->pluck('year')->filter()->sort()->values(),
                'modules' => MonitoredSessions2026::distinct()
                    ->pluck('ModuleCode')
                    ->filter()
                    ->sort()
                    ->values(),
                'clinical_subtypes' => MonitoredSessions2026::distinct()
                    ->whereNotNull('ClinicalSubType')
                    ->pluck('ClinicalSubType')
                    ->filter()
                    ->sort()
                    ->values(),
            ];
        });
    }

    /**
     * Get a single student with full attendance details
     *
     * @param int $studentId
     * @param array $filters
     * @return Student|null
     */
    public function getStudentWithAttendance(int $studentId, array $filters = [])
    {
        $student = Student::with([
            'sessionAttendance' => function ($q) use ($filters) {
                $this->applySessionFilters($q, $filters);
                $q->orderBy('session_date', 'desc');
            },
            'sessionAttendance.session',
            'locationSignoffs' => function ($q) use ($filters) {
                $this->applyDateRangeFilter($q, $filters, 'created_at');
                $q->orderBy('created_at', 'desc');
            },
            'locationSignoffs.location',
            'examinationResults' => function ($q) use ($filters) {
                $this->applyDateRangeFilter($q, $filters, 'assessed_at');
                $q->orderBy('assessed_at', 'desc');
            },
            'examinationResults.examination'
        ])->find($studentId);

        if ($student) {
            $student->attendance_stats = [
                'total_sessions' => $student->sessionAttendance->count(),
                'total_locations' => $student->locationSignoffs->count(),
                'total_examinations' => $student->examinationResults->count(),
                'competent_examinations' => $student->examinationResults->where('is_competent', true)->count(),
                'not_competent_examinations' => $student->examinationResults->where('is_competent', false)->count(),
            ];
        }

        return $student;
    }

    /**
     * Prepare data for CSV export
     *
     * @param array $filters
     * @return array
     */
    public function prepareCSVData(array $filters = [])
    {
        $students = $this->getAllStudentsWithAttendance($filters);
        
        $csvData = [];
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

        foreach ($students as $student) {
            $csvData[] = [
                $student->bsms_id ?? $student->user_id ?? '',
                $student->name ?? '',
                $student->student_number ?? '',
                $student->year ?? '',
                $student->email ?? '',
                $student->attendance_stats['total_sessions'],
                $student->attendance_stats['total_locations'],
                $student->attendance_stats['total_examinations'],
                $student->attendance_stats['competent_examinations'],
                $student->attendance_stats['not_competent_examinations'],
            ];
        }

        return $csvData;
    }
}
