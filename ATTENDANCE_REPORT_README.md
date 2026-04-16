# All Students Attendance Report System

## Overview

This system provides a comprehensive attendance reporting solution for all students, with advanced filtering capabilities and PDF/CSV export functionality for both individual students and entire cohorts.

## Features

### 1. **All Students Attendance Report (Nova Tool)**
- View all students with their attendance summary counts
- Expandable sections showing detailed attendance records per student
- Real-time filtering interface
- Accessible via Nova sidebar: "All Students Attendance"

### 2. **Advanced Filtering**
- **Year/Cohort**: Filter students by year group
- **Module/Session Type**: Filter by specific modules (BSMS101, BSMS201, etc.) or clinical subtypes
- **Date Range**: Select specific date ranges for attendance records
- **Attendance Thresholds**: Show students above/below certain attendance counts

### 3. **Export Capabilities**

#### Individual Student PDF Export
- Detailed report with student info, statistics, and full attendance history
- Includes session attendance, location signoffs, and examination results
- Professional BSMS branding

#### Cohort PDF Export (3 Detail Levels)
- **Summary**: One-page overview per student with key statistics
- **Detailed**: Full report for each student (similar to individual PDFs)
- **Comparison**: Table format showing all students side-by-side

#### CSV Export
- Export filtered attendance data for analysis
- Includes all key metrics for each student

## Components Created

### Backend Services
1. **AttendanceReportService** (`app/Services/AttendanceReportService.php`)
   - Optimized queries with eager loading
   - Filter application logic
   - Statistics calculation
   - CSV data preparation

2. **AttendanceReportController** (`app/Http/Controllers/AttendanceReportController.php`)
   - API endpoints for data fetching
   - PDF and CSV export handlers
   - Filter management

### Nova Components
1. **AllStudentsAttendance Tool** (`app/Nova/Tools/AllStudentsAttendance.php`)
   - Nova sidebar integration
   - Main tool entry point

2. **Nova Actions**
   - `ExportAttendancePDF` - Individual student PDF export
   - `ExportCohortAttendancePDF` - Cohort PDF export with detail level selection
   - `ExportAttendanceCSV` - CSV data export

3. **Student Resource** (`app/Nova/GPClinicalSkills/Student.php`)
   - Complete student management
   - Integrated export actions
   - Relationships to attendance data

### Views & Templates
1. **Tool Interface** (`resources/views/nova/tools/all-students-attendance.blade.php`)
   - Interactive filter controls
   - Student list with expandable details
   - Statistics dashboard
   - Export buttons

2. **PDF Templates**
   - Individual: `resources/views/pdf/attendance-report.blade.php` (existing)
   - Cohort: `resources/views/pdf/cohort-attendance-report.blade.php` (new)

### API Routes
All routes are prefixed with `/api/attendance/`:
- `GET all-students` - Fetch all students with attendance
- `POST filter` - Apply filters and return filtered data
- `GET statistics` - Overall attendance statistics
- `GET filter-options` - Available filter options (years, modules, etc.)
- `GET student/{id}` - Single student with full details
- `GET/POST export-cohort-pdf` - Generate cohort PDF
- `GET export-csv` - Generate CSV export

## Usage Instructions

### Accessing the Tool

1. **Via Nova Sidebar**
   - Log into Laravel Nova admin panel
   - Click "All Students Attendance" in the sidebar
   - The tool will load with all students displayed

2. **Via Student Resource**
   - Navigate to GP/Clinical Skills → Students
   - Select one or more students
   - Use the Actions dropdown to:
     - Export individual PDFs
     - Export cohort PDF
     - Export CSV data

### Using Filters

1. **Apply Filters**
   - Select desired filter criteria (year, module, dates, thresholds)
   - Click "Apply Filters" button
   - Results update automatically

2. **Reset Filters**
   - Click "Reset" button to clear all filters
   - Returns to showing all students

### Exporting Data

#### From the Tool Interface
1. **Cohort PDF**
   - Click "Export Cohort PDF" button
   - Choose detail level (1=Summary, 2=Detailed, 3=Comparison)
   - PDF downloads automatically

2. **CSV Export**
   - Click "Export CSV" button
   - CSV file downloads with filtered data

#### From Student Resource
1. Select students in the Nova resource list
2. Choose action from dropdown
3. For cohort PDF, select detail level
4. Click "Run" to execute

## Data Structure

### Student Attendance Statistics
Each student record includes:
- `total_sessions` - Number of sessions attended
- `total_locations` - Number of placement locations visited
- `total_examinations` - Number of examinations taken
- `competent_examinations` - Number passed as competent
- `not_competent_examinations` - Number not yet competent

### Related Models
- `SessionAttendance2026` - Teaching session attendance records
- `LocationSignoff` - Placement location signoffs with signatures
- `ExaminationResult` - Clinical examination results
- `MonitoredSessions2026` - Available teaching sessions
- `Location2025` - Placement locations

## Performance Considerations

### Optimizations Implemented
1. **Eager Loading**: All relationships loaded efficiently
2. **Caching**: Filter options cached for 1 hour
3. **Pagination**: Large datasets handled via pagination
4. **Selective Loading**: Only necessary fields loaded

### For Large Cohorts
- Consider queuing PDF generation for 100+ students
- Use summary or comparison mode for faster generation
- Apply filters to reduce dataset size

## Testing Checklist

### Basic Functionality
- [ ] Tool appears in Nova sidebar
- [ ] All students load correctly
- [ ] Statistics display accurately
- [ ] Student details expand/collapse

### Filtering
- [ ] Year filter works
- [ ] Module filter works
- [ ] Date range filter works
- [ ] Threshold filters work
- [ ] Multiple filters combine correctly
- [ ] Reset clears all filters

### Exports
- [ ] Individual PDF generates correctly
- [ ] Cohort PDF (summary) generates
- [ ] Cohort PDF (detailed) generates
- [ ] Cohort PDF (comparison) generates
- [ ] CSV export includes correct data
- [ ] Exports respect active filters

### Data Accuracy
- [ ] Session counts match database
- [ ] Location counts match database
- [ ] Examination results accurate
- [ ] Statistics calculations correct

## Troubleshooting

### Tool Not Appearing
- Check NovaServiceProvider has tool registered
- Clear Laravel cache: `php artisan cache:clear`
- Clear Nova cache: `php artisan nova:publish`

### API Errors
- Verify routes are registered: `php artisan route:list`
- Check database connections
- Review Laravel logs: `storage/logs/laravel.log`

### PDF Generation Issues
- Ensure DomPDF package installed
- Check memory limits in php.ini
- Verify view templates exist
- Test with small datasets first

### Missing Data
- Verify relationships in Student model
- Check eager loading in service
- Ensure foreign keys are correct
- Review migration files

## Database Requirements

### Required Tables
- `students` - Student records
- `session_attendance_2026` - Session attendance
- `location_signoffs` - Location signoffs
- `examination_results` - Examination results (if exists)
- `MonitoredSessions2026` - Available sessions
- `locations2025` - Placement locations

### Required Relationships
All relationships defined in `Student` model:
- `sessionAttendance()` - hasMany SessionAttendance2026
- `locationSignoffs()` - hasMany LocationSignoff
- `examinationResults()` - hasMany ExaminationResult

## Security

### Access Control
- Tool requires authentication
- Uses Nova's built-in gate system
- Respects NOVA_ACCESS_ROLES environment variable

### Data Protection
- All exports include student confidential data
- PDFs marked as "Confidential"
- API routes should be protected in production

## Future Enhancements

### Potential Improvements
1. Email delivery of reports
2. Scheduled automatic reports
3. Comparison across cohorts/years
4. Attendance trend analysis
5. Predictive analytics for at-risk students
6. Integration with student notifications
7. Custom report templates
8. Excel export option

## Support

For issues or questions:
1. Check Laravel logs
2. Review this documentation
3. Test with sample data
4. Contact system administrator

## Version History

### v1.0.0 (March 2026)
- Initial implementation
- All students attendance tool
- Advanced filtering
- PDF exports (individual and cohort)
- CSV export
- Nova integration
