<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Report - {{ $student->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #005e7e;
        }
        .header h1 {
            color: #005e7e;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .student-info {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .student-info table {
            width: 100%;
        }
        .student-info td {
            padding: 5px;
        }
        .student-info td:first-child {
            font-weight: bold;
            width: 150px;
        }
        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .stat-box {
            display: table-cell;
            background: #005e7e;
            color: white;
            padding: 15px;
            text-align: center;
            margin-right: 10px;
            border-radius: 5px;
        }
        .stat-box .number {
            font-size: 28px;
            font-weight: bold;
            display: block;
        }
        .stat-box .label {
            font-size: 10px;
            display: block;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section h2 {
            color: #005e7e;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #005e7e;
        }
        .card {
            background: #005e7e;
            color: white;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 5px;
            page-break-inside: avoid;
        }
        .card-title {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .card-detail {
            font-size: 10px;
            margin-bottom: 3px;
        }
        .card-date {
            font-size: 10px;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid rgba(255,255,255,0.3);
        }
        .signature-box {
            background: white;
            padding: 10px;
            margin-top: 8px;
            border-radius: 3px;
            min-height: 50px;
        }
        .competent {
            background: #10b981;
        }
        .not-competent {
            background: #6b7280;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            background: rgba(255,255,255,0.2);
            border-radius: 3px;
            font-weight: bold;
            margin-top: 5px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9px;
            color: #999;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Student Attendance Report</h1>
        <p>Generated: {{ $generated_at }}</p>
    </div>

    <div class="student-info">
        <table>
            <tr>
                <td>Name:</td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td>BSMS ID:</td>
                <td>{{ $student->user_id }}</td>
            </tr>
            <tr>
                <td>Student Number:</td>
                <td>{{ $student->student_number }}</td>
            </tr>
            <tr>
                <td>Year:</td>
                <td>{{ $student->year }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $student->email }}</td>
            </tr>
        </table>
    </div>

    <div class="statistics">
        <div class="stat-box">
            <span class="number">{{ $statistics['total_sessions'] }}</span>
            <span class="label">Teaching Sessions</span>
        </div>
        <div class="stat-box">
            <span class="number">{{ $statistics['total_locations'] }}</span>
            <span class="label">Placement Locations</span>
        </div>
        <div class="stat-box">
            <span class="number">{{ $statistics['competent_examinations'] }}</span>
            <span class="label">Competent Exams</span>
        </div>
        <div class="stat-box">
            <span class="number">{{ $statistics['not_competent_examinations'] }}</span>
            <span class="label">Not Yet Competent</span>
        </div>
    </div>

    @if($sessionAttendance->count() > 0)
    <div class="section">
        <h2>Session Attendance ({{ $sessionAttendance->count() }} sessions)</h2>
        @foreach($sessionAttendance as $attendance)
        <div class="card">
            <div class="card-title">{{ $attendance->session->SessionTitle ?? 'Unknown Session' }}</div>
            <div class="card-detail"><strong>Module:</strong> {{ $attendance->session->ModuleCode ?? 'N/A' }}</div>
            @if($attendance->session->ClinicalSubType)
            <div class="card-detail"><strong>Type:</strong> {{ $attendance->session->ClinicalSubType }}</div>
            @endif
            <div class="card-detail"><strong>Session ID:</strong> {{ $attendance->session_id }}</div>
            <div class="card-detail"><strong>BSMS ID:</strong> {{ $attendance->bsms_id }}</div>
            <div class="card-date">📅 {{ $attendance->session_date->format('d M Y, H:i') }}</div>
        </div>
        @endforeach
    </div>
    @endif

    @if($locationSignoffs->count() > 0)
    <div class="section page-break">
        <h2>Placement Location Signoffs ({{ $locationSignoffs->count() }} locations)</h2>
        @foreach($locationSignoffs as $signoff)
        <div class="card">
            <div class="card-title">{{ $signoff->location->name ?? 'Unknown Location' }}</div>
            <div class="card-detail"><strong>Barcode:</strong> {{ $signoff->location_barcode }}</div>
            <div class="card-detail"><strong>BSMS ID:</strong> {{ $signoff->bsms_id }}</div>
            @if($signoff->signoff_name)
            <div class="card-detail"><strong>Approver:</strong> {{ $signoff->signoff_name }}</div>
            @endif
            @if($signoff->reg_number_of_approver)
            <div class="card-detail"><strong>Reg #:</strong> {{ $signoff->reg_number_of_approver }}</div>
            @endif
            @if($signoff->location_postcode)
            <div class="card-detail"><strong>Postcode:</strong> {{ $signoff->location_postcode }}</div>
            @endif
            <div class="card-date">📅 {{ $signoff->created_at->format('d M Y, H:i') }}</div>
            @if($signoff->signature_svg)
            <div class="signature-box">
                <svg width="100%" height="60" viewBox="0 0 300 100" style="border: 1px solid #ddd;">
                    <path d="{{ $signoff->signature_svg }}" stroke="#000" stroke-width="2" fill="none" />
                </svg>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($examinationResults->count() > 0)
    <div class="section page-break">
        <h2>Examination Results ({{ $examinationResults->count() }} total)</h2>
        @foreach($examinationResults as $result)
        <div class="card {{ $result->is_competent ? 'competent' : 'not-competent' }}">
            <div class="card-title">{{ $result->examination->examination ?? 'Unknown Examination' }}</div>
            @if($result->examination->category)
            <div class="card-detail"><strong>Category:</strong> {{ $result->examination->category }}</div>
            @endif
            <div class="card-detail"><strong>BSMS ID:</strong> {{ $result->bsms_id }}</div>
            <div class="status-badge">{{ $result->is_competent ? '✓ Competent' : '✗ Not Yet Competent' }}</div>
            <div class="card-date">📅 {{ $result->assessed_at->format('d M Y, H:i') }}</div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="footer">
        <p>BSMS Attendance Report - Confidential - Page {PAGE_NUM} of {PAGE_COUNT}</p>
    </div>
</body>
</html>
