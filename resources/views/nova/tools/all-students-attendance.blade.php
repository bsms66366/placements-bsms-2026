<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students Attendance</title>
    <style>
        .attendance-container {
            padding: 20px;
        }
        .filters-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .filter-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        .filter-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #374151;
        }
        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #005e7e;
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .stat-card .label {
            font-size: 14px;
            opacity: 0.9;
        }
        .students-list {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .student-item {
            border-bottom: 1px solid #e5e7eb;
            padding: 15px 20px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .student-item:hover {
            background: #f9fafb;
        }
        .student-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .student-name {
            font-weight: 600;
            font-size: 16px;
            color: #111827;
        }
        .student-info {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }
        .student-stats {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }
        .stat-badge {
            background: #005e7e;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
        }
        .actions-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }
        .btn-primary {
            background: #005e7e;
            color: white;
        }
        .btn-primary:hover {
            background: #004a63;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-secondary:hover {
            background: #4b5563;
        }
        .loading {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }
        .student-details {
            display: none;
            padding: 15px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        .student-details.active {
            display: block;
        }
        .detail-section {
            margin-bottom: 15px;
        }
        .detail-section h4 {
            color: #005e7e;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .detail-list {
            max-height: 200px;
            overflow-y: auto;
        }
        .detail-item {
            background: white;
            padding: 8px;
            margin-bottom: 5px;
            border-radius: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="attendance-container">
        <h1 style="color: #005e7e; margin-bottom: 20px;">All Students Attendance Report</h1>

        <div class="filters-section">
            <h3 style="margin-bottom: 15px; color: #374151;">Filters</h3>
            <div class="filter-row">
                <div class="filter-group">
                    <label>Year</label>
                    <select id="filter-year">
                        <option value="">All Years</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Module</label>
                    <select id="filter-module" multiple>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Date From</label>
                    <input type="date" id="filter-date-from">
                </div>
                <div class="filter-group">
                    <label>Date To</label>
                    <input type="date" id="filter-date-to">
                </div>
            </div>
            <div class="filter-row">
                <div class="filter-group">
                    <label>Min Sessions</label>
                    <input type="number" id="filter-min-sessions" placeholder="0">
                </div>
                <div class="filter-group">
                    <label>Max Sessions</label>
                    <input type="number" id="filter-max-sessions" placeholder="999">
                </div>
                <div class="filter-group">
                    <label>Min Locations</label>
                    <input type="number" id="filter-min-locations" placeholder="0">
                </div>
                <div class="filter-group">
                    <label>Max Locations</label>
                    <input type="number" id="filter-max-locations" placeholder="999">
                </div>
            </div>
            <button class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
            <button class="btn btn-secondary" onclick="resetFilters()">Reset</button>
        </div>

        <div class="actions-bar">
            <button class="btn btn-primary" onclick="exportCohortPDF()">Export Cohort PDF</button>
            <button class="btn btn-secondary" onclick="exportCSV()">Export CSV</button>
        </div>

        <div class="statistics-grid" id="statistics">
            <div class="stat-card">
                <span class="number" id="stat-students">0</span>
                <span class="label">Students</span>
            </div>
            <div class="stat-card">
                <span class="number" id="stat-sessions">0</span>
                <span class="label">Total Sessions</span>
            </div>
            <div class="stat-card">
                <span class="number" id="stat-locations">0</span>
                <span class="label">Total Locations</span>
            </div>
            <div class="stat-card">
                <span class="number" id="stat-exams">0</span>
                <span class="label">Total Exams</span>
            </div>
            <div class="stat-card">
                <span class="number" id="stat-avg-sessions">0</span>
                <span class="label">Avg Sessions/Student</span>
            </div>
            <div class="stat-card">
                <span class="number" id="stat-avg-locations">0</span>
                <span class="label">Avg Locations/Student</span>
            </div>
        </div>

        <div class="students-list" id="students-list">
            <div class="loading">Loading students...</div>
        </div>
    </div>

    <script>
        let currentFilters = {};
        let allStudents = [];

        async function loadFilterOptions() {
            try {
                const response = await fetch('/api/attendance/filter-options');
                const options = await response.json();
                
                const yearSelect = document.getElementById('filter-year');
                options.years.forEach(year => {
                    const option = document.createElement('option');
                    option.value = year;
                    option.textContent = `Year ${year}`;
                    yearSelect.appendChild(option);
                });

                const moduleSelect = document.getElementById('filter-module');
                options.modules.forEach(module => {
                    const option = document.createElement('option');
                    option.value = module;
                    option.textContent = module;
                    moduleSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error loading filter options:', error);
            }
        }

        async function loadStudents() {
            try {
                const queryParams = new URLSearchParams(currentFilters);
                const response = await fetch(`/api/attendance/all-students?${queryParams}`);
                const data = await response.json();
                
                allStudents = data.students;
                renderStudents(data.students);
                loadStatistics();
            } catch (error) {
                console.error('Error loading students:', error);
                document.getElementById('students-list').innerHTML = '<div class="loading">Error loading students</div>';
            }
        }

        async function loadStatistics() {
            try {
                const queryParams = new URLSearchParams(currentFilters);
                const response = await fetch(`/api/attendance/statistics?${queryParams}`);
                const stats = await response.json();
                
                document.getElementById('stat-students').textContent = stats.total_students;
                document.getElementById('stat-sessions').textContent = stats.total_sessions_recorded;
                document.getElementById('stat-locations').textContent = stats.total_locations_visited;
                document.getElementById('stat-exams').textContent = stats.total_examinations;
                document.getElementById('stat-avg-sessions').textContent = stats.average_sessions_per_student;
                document.getElementById('stat-avg-locations').textContent = stats.average_locations_per_student;
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        function renderStudents(students) {
            const container = document.getElementById('students-list');
            
            if (students.length === 0) {
                container.innerHTML = '<div class="loading">No students found</div>';
                return;
            }

            container.innerHTML = students.map((student, index) => `
                <div class="student-item" onclick="toggleDetails(${index})">
                    <div class="student-header">
                        <div>
                            <div class="student-name">${student.name || 'N/A'}</div>
                            <div class="student-info">
                                ${student.bsms_id || student.user_id || 'N/A'} | 
                                ${student.student_number || 'N/A'} | 
                                Year ${student.year || 'N/A'}
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <span class="stat-badge">Sessions: ${student.attendance_stats.total_sessions}</span>
                        <span class="stat-badge">Locations: ${student.attendance_stats.total_locations}</span>
                        <span class="stat-badge">Exams: ${student.attendance_stats.total_examinations}</span>
                        <span class="stat-badge">Competent: ${student.attendance_stats.competent_examinations}</span>
                    </div>
                    <div class="student-details" id="details-${index}">
                        <div class="detail-section">
                            <h4>Recent Sessions (${student.session_attendance?.length || 0})</h4>
                            <div class="detail-list">
                                ${(student.session_attendance || []).slice(0, 5).map(att => `
                                    <div class="detail-item">
                                        ${att.session?.SessionTitle || 'Unknown'} - ${att.session?.ModuleCode || 'N/A'}
                                    </div>
                                `).join('') || '<div class="detail-item">No sessions recorded</div>'}
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function toggleDetails(index) {
            const details = document.getElementById(`details-${index}`);
            details.classList.toggle('active');
        }

        function applyFilters() {
            currentFilters = {
                year: document.getElementById('filter-year').value,
                date_from: document.getElementById('filter-date-from').value,
                date_to: document.getElementById('filter-date-to').value,
                min_sessions: document.getElementById('filter-min-sessions').value,
                max_sessions: document.getElementById('filter-max-sessions').value,
                min_locations: document.getElementById('filter-min-locations').value,
                max_locations: document.getElementById('filter-max-locations').value,
            };

            Object.keys(currentFilters).forEach(key => {
                if (!currentFilters[key]) delete currentFilters[key];
            });

            loadStudents();
        }

        function resetFilters() {
            document.getElementById('filter-year').value = '';
            document.getElementById('filter-date-from').value = '';
            document.getElementById('filter-date-to').value = '';
            document.getElementById('filter-min-sessions').value = '';
            document.getElementById('filter-max-sessions').value = '';
            document.getElementById('filter-min-locations').value = '';
            document.getElementById('filter-max-locations').value = '';
            currentFilters = {};
            loadStudents();
        }

        function exportCohortPDF() {
            const detailLevel = prompt('Select detail level:\n1. Summary\n2. Detailed\n3. Comparison\n\nEnter 1, 2, or 3:', '1');
            const levels = { '1': 'summary', '2': 'detailed', '3': 'comparison' };
            
            window.location.href = `/api/attendance/export-cohort-pdf?detail_level=${levels[detailLevel] || 'summary'}&${new URLSearchParams(currentFilters)}`;
        }

        function exportCSV() {
            window.location.href = `/api/attendance/export-csv?${new URLSearchParams(currentFilters)}`;
        }

        loadFilterOptions();
        loadStudents();
    </script>
</body>
</html>
