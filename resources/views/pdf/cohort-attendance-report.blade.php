<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cohort Attendance Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #333;
            line-height: 1.3;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #005e7e;
        }
        .header h1 {
            color: #005e7e;
            font-size: 22px;
            margin: 0 0 8px 0;
        }
        .header p {
            margin: 3px 0;
            font-size: 10px;
        }
        .statistics-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        .stat-row {
            display: table-row;
        }
        .stat-box {
            display: table-cell;
            background: #005e7e;
            color: white;
            padding: 12px;
            text-align: center;
            margin-right: 8px;
            border-radius: 4px;
            width: 16.66%;
        }
        .stat-box .number {
            font-size: 20px;
            font-weight: bold;
            display: block;
        }
        .stat-box .label {
            font-size: 8px;
            display: block;
            margin-top: 4px;
        }
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section h2 {
            color: #005e7e;
            font-size: 16px;
            margin-bottom: 12px;
            padding-bottom: 4px;
            border-bottom: 2px solid #005e7e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th {
            background: #005e7e;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }
        table td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
            font-size: 9px;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .student-card {
            background: #f5f5f5;
            padding: 10px;
            margin-bottom: 12px;
            border-left: 4px solid #005e7e;
            page-break-inside: avoid;
        }
        .student-card h3 {
            color: #005e7e;
            font-size: 12px;
            margin: 0 0 8px 0;
        }
        .student-card .info-row {
            margin-bottom: 4px;
            font-size: 9px;
        }
        .student-card .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        .stats-inline {
            display: inline-block;
            background: #005e7e;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            margin-right: 6px;
            font-size: 8px;
            margin-top: 6px;
        }
        .detail-section {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .detail-item {
            background: white;
            padding: 6px;
            margin-bottom: 4px;
            border-radius: 3px;
            font-size: 8px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #999;
            padding-top: 8px;
            border-top: 1px solid #ddd;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Cohort Attendance Report</h1>
        <p><strong>Generated:</strong> {{ $generated_at }}</p>
        <p><strong>Total Students:</strong> {{ $statistics['total_students'] }}</p>
    </div>

    <div class="statistics-grid">
        <div class="stat-row">
            <div class="stat-box">
                <span class="number">{{ $statistics['total_students'] }}</span>
                <span class="label">Students</span>
            </div>
            <div class="stat-box">
                <span class="number">{{ $statistics['total_sessions_recorded'] }}</span>
                <span class="label">Total Sessions</span>
            </div>
            <div class="stat-box">
                <span class="number">{{ $statistics['total_locations_visited'] }}</span>
                <span class="label">Total Locations</span>
            </div>
            <div class="stat-box">
                <span class="number">{{ $statistics['total_examinations'] }}</span>
                <span class="label">Total Exams</span>
            </div>
            <div class="stat-box">
                <span class="number">{{ $statistics['average_sessions_per_student'] }}</span>
                <span class="label">Avg Sessions/Student</span>
            </div>
            <div class="stat-box">
                <span class="number">{{ $statistics['average_locations_per_student'] }}</span>
                <span class="label">Avg Locations/Student</span>
            </div>
        </div>
    </div>

    @if($detail_level === 'comparison')
        <div class="section">
            <h2>Student Attendance Comparison</h2>
            <table>
                <thead>
                    <tr>
                        <th>BSMS ID</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Sessions</th>
                        <th>Locations</th>
                        <th>Exams</th>
                        <th>Competent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->bsms_id ?? $student->user_id ?? 'N/A' }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->year ?? 'N/A' }}</td>
                        <td>{{ $student->attendance_stats['total_sessions'] }}</td>
                        <td>{{ $student->attendance_stats['total_locations'] }}</td>
                        <td>{{ $student->attendance_stats['total_examinations'] }}</td>
                        <td>{{ $student->attendance_stats['competent_examinations'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($detail_level === 'summary')
        <div class="section">
            <h2>Student Summary</h2>
            @foreach($students as $student)
            <div class="student-card">
                <h3>{{ $student->name }}</h3>
                <div class="info-row">
                    <span class="info-label">BSMS ID:</span>
                    <span>{{ $student->bsms_id ?? $student->user_id ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Student Number:</span>
                    <span>{{ $student->student_number ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Year:</span>
                    <span>{{ $student->year ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span>{{ $student->email ?? 'N/A' }}</span>
                </div>
                <div style="margin-top: 8px;">
                    <span class="stats-inline">Sessions: {{ $student->attendance_stats['total_sessions'] }}</span>
                    <span class="stats-inline">Locations: {{ $student->attendance_stats['total_locations'] }}</span>
                    <span class="stats-inline">Exams: {{ $student->attendance_stats['total_examinations'] }}</span>
                    <span class="stats-inline">Competent: {{ $student->attendance_stats['competent_examinations'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if($detail_level === 'detailed')
        @foreach($students as $index => $student)
        @if($index > 0)
        <div class="page-break"></div>
        @endif
        
        <div class="section">
            <h2>{{ $student->name }} - Detailed Report</h2>
            
            <div class="student-card">
                <div class="info-row">
                    <span class="info-label">BSMS ID:</span>
                    <span>{{ $student->bsms_id ?? $student->user_id ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Student Number:</span>
                    <span>{{ $student->student_number ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Year:</span>
                    <span>{{ $student->year ?? 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span>{{ $student->email ?? 'N/A' }}</span>
                </div>
            </div>

            @if($student->sessionAttendance->count() > 0)
            <div class="detail-section">
                <h3 style="font-size: 12px; color: #005e7e; margin-bottom: 8px;">Session Attendance ({{ $student->sessionAttendance->count() }})</h3>
                @foreach($student->sessionAttendance->take(10) as $attendance)
                <div class="detail-item">
                    <strong>{{ $attendance->session->SessionTitle ?? 'Unknown Session' }}</strong><br>
                    Module: {{ $attendance->session->ModuleCode ?? 'N/A' }} | 
                    Date: {{ $attendance->session_date->format('d M Y, H:i') }}
                </div>
                @endforeach
                @if($student->sessionAttendance->count() > 10)
                <p style="font-size: 8px; font-style: italic; margin-top: 5px;">
                    ... and {{ $student->sessionAttendance->count() - 10 }} more sessions
                </p>
                @endif
            </div>
            @endif

            @if($student->locationSignoffs->count() > 0)
            <div class="detail-section">
                <h3 style="font-size: 12px; color: #005e7e; margin-bottom: 8px;">Location Signoffs ({{ $student->locationSignoffs->count() }})</h3>
                @foreach($student->locationSignoffs->take(10) as $signoff)
                <div class="detail-item">
                    <strong>{{ $signoff->location->name ?? 'Unknown Location' }}</strong><br>
                    Barcode: {{ $signoff->location_barcode }} | 
                    Approver: {{ $signoff->signoff_name ?? 'N/A' }} | 
                    Date: {{ $signoff->created_at->format('d M Y, H:i') }}
                    @if($signoff->signature_svg)
                    <div style="margin-top: 8px; padding: 5px; border: 1px solid #ddd; background: #f9f9f9;">
                        <svg width="100%" height="50" viewBox="0 0 300 100" style="display: block;">
                            <path d="{{ $signoff->signature_svg }}" stroke="#000" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    @endif
                </div>
                @endforeach
                @if($student->locationSignoffs->count() > 10)
                <p style="font-size: 8px; font-style: italic; margin-top: 5px;">
                    ... and {{ $student->locationSignoffs->count() - 10 }} more signoffs
                </p>
                @endif
            </div>
            @endif

            @if($student->examinationResults->count() > 0)
            <div class="detail-section">
                <h3 style="font-size: 12px; color: #005e7e; margin-bottom: 8px;">Examination Results ({{ $student->examinationResults->count() }})</h3>
                @foreach($student->examinationResults->take(10) as $result)
                <div class="detail-item">
                    <strong>{{ $result->examination->examination ?? 'Unknown Examination' }}</strong><br>
                    Status: {{ $result->is_competent ? 'Competent' : 'Not Yet Competent' }} | 
                    Date: {{ $result->assessed_at->format('d M Y, H:i') }}
                </div>
                @endforeach
                @if($student->examinationResults->count() > 10)
                <p style="font-size: 8px; font-style: italic; margin-top: 5px;">
                    ... and {{ $student->examinationResults->count() - 10 }} more results
                </p>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    @endif

    <div class="footer">
        <p>BSMS Cohort Attendance Report - Confidential - Page {PAGE_NUM} of {PAGE_COUNT}</p>
    </div>
</body>
</html>
