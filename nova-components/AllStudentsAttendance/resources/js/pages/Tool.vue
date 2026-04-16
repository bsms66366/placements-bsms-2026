<template>
  <div>
    <Head title="All Students Attendance" />

    <Heading class="mb-6">All Students Attendance Report</Heading>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.total_students }}</div>
          <div class="text-sm opacity-90">Students</div>
        </div>
      </Card>
      
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.total_sessions_recorded }}</div>
          <div class="text-sm opacity-90">Total Sessions</div>
        </div>
      </Card>
      
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.total_locations_visited }}</div>
          <div class="text-sm opacity-90">Total Locations</div>
        </div>
      </Card>
      
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.total_examinations }}</div>
          <div class="text-sm opacity-90">Total Exams</div>
        </div>
      </Card>
      
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.average_sessions_per_student }}</div>
          <div class="text-sm opacity-90">Avg Sessions</div>
        </div>
      </Card>
      
      <Card class="bg-primary-500 text-white">
        <div class="p-4 text-center">
          <div class="text-3xl font-bold">{{ statistics.average_locations_per_student }}</div>
          <div class="text-sm opacity-90">Avg Locations</div>
        </div>
      </Card>
    </div>

    <!-- Filters Card -->
    <Card class="mb-6">
      <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Filters</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div>
            <label class="block text-sm font-medium mb-2">Year</label>
            <select v-model="filters.year" class="w-full form-control form-select">
              <option value="">All Years</option>
              <option v-for="year in filterOptions.years" :key="year" :value="year">
                Year {{ year }}
              </option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium mb-2">Date From</label>
            <input type="date" v-model="filters.date_from" class="w-full form-control form-input" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-2">Date To</label>
            <input type="date" v-model="filters.date_to" class="w-full form-control form-input" />
          </div>

          <div>
            <label class="block text-sm font-medium mb-2">Min Sessions</label>
            <input type="number" v-model="filters.min_sessions" placeholder="0" class="w-full form-control form-input" />
          </div>
        </div>

        <div class="flex gap-2">
          <button @click="applyFilters" class="btn btn-default btn-primary">
            Apply Filters
          </button>
          <button @click="resetFilters" class="btn btn-default">
            Reset
          </button>
        </div>
      </div>
    </Card>

    <!-- Export Actions -->
    <div class="flex gap-2 mb-6">
      <button @click="exportCohortPDF" class="btn btn-default btn-primary">
        Export Cohort PDF
      </button>
      <button @click="exportCSV" class="btn btn-default">
        Export CSV
      </button>
    </div>

    <!-- Students List -->
    <Card>
      <div v-if="loading" class="p-8 text-center">
        <LoadingView />
      </div>

      <div v-else-if="students.length === 0" class="p-8 text-center text-gray-500">
        No students found
      </div>

      <div v-else>
        <div v-for="student in students" :key="student.id" class="border-b border-gray-200 dark:border-gray-700">
          <div @click="toggleStudent(student.id)" class="p-4 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
            <div class="flex justify-between items-start">
              <div>
                <h4 class="font-bold text-lg">{{ student.name }}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                  {{ student.bsms_id || student.user_id }} | 
                  {{ student.student_number }} | 
                  Year {{ student.year }}
                </p>
              </div>
              <div class="text-right">
                <svg v-if="expandedStudents.includes(student.id)" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                <svg v-else class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
            
            <div class="flex gap-2 mt-3">
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                Sessions: {{ student.attendance_stats.total_sessions }}
              </span>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                Locations: {{ student.attendance_stats.total_locations }}
              </span>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                Exams: {{ student.attendance_stats.total_examinations }}
              </span>
              <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                Competent: {{ student.attendance_stats.competent_examinations }}
              </span>
            </div>
          </div>

          <!-- Expanded Details -->
          <div v-if="expandedStudents.includes(student.id)" class="p-4 bg-gray-50 dark:bg-gray-800">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <h5 class="font-semibold mb-2">Recent Sessions</h5>
                <div class="space-y-1 text-sm">
                  <div v-if="!student.session_attendance || student.session_attendance.length === 0" class="text-gray-500">
                    No sessions recorded
                  </div>
                  <div v-else v-for="(attendance, idx) in student.session_attendance.slice(0, 5)" :key="idx" class="p-2 bg-white dark:bg-gray-900 rounded">
                    {{ attendance.session?.SessionTitle || 'Unknown' }}
                  </div>
                </div>
              </div>
              
              <div>
                <h5 class="font-semibold mb-2">Recent Signoffs</h5>
                <div class="space-y-2 text-sm">
                  <div v-if="!student.location_signoffs || student.location_signoffs.length === 0" class="text-gray-500">
                    No signoffs recorded
                  </div>
                  <div v-else v-for="(signoff, idx) in student.location_signoffs.slice(0, 5)" :key="idx" class="p-3 bg-white dark:bg-gray-900 rounded border border-gray-200 dark:border-gray-700">
                    <div class="font-medium mb-1">{{ signoff.location?.name || 'Unknown Location' }}</div>
                    <div v-if="signoff.signoff_name" class="text-xs text-gray-600 dark:text-gray-400 mb-1">
                      Signed by: {{ signoff.signoff_name }}
                    </div>
                    <div v-if="signoff.created_at" class="text-xs text-gray-500 dark:text-gray-500 mb-2">
                      {{ formatDate(signoff.created_at) }}
                    </div>
                    <div v-if="signoff.signature_svg" class="mt-2 p-2 bg-white dark:bg-gray-700 rounded border border-gray-300 dark:border-gray-600">
                      <div class="text-xs text-gray-500 mb-1">Signature:</div>
                      <div v-html="renderSignature(signoff.signature_svg)" class="signature-display"></div>
                    </div>
                    <div v-else class="mt-2 text-xs text-gray-400 italic">
                      No signature available
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      students: [],
      statistics: {
        total_students: 0,
        total_sessions_recorded: 0,
        total_locations_visited: 0,
        total_examinations: 0,
        average_sessions_per_student: 0,
        average_locations_per_student: 0,
      },
      filterOptions: {
        years: [],
        modules: [],
        clinical_subtypes: [],
      },
      filters: {
        year: '',
        date_from: '',
        date_to: '',
        min_sessions: '',
        max_sessions: '',
        min_locations: '',
        max_locations: '',
      },
      loading: true,
      expandedStudents: [],
    }
  },

  mounted() {
    this.loadFilterOptions()
    this.loadStudents()
    this.loadStatistics()
  },

  methods: {
    async loadFilterOptions() {
      try {
        const response = await Nova.request().get('/api/attendance/filter-options')
        this.filterOptions = response.data
      } catch (error) {
        console.error('Error loading filter options:', error)
      }
    },

    async loadStudents() {
      this.loading = true
      try {
        const params = new URLSearchParams(this.filters)
        const response = await Nova.request().get(`/api/attendance/all-students?${params}`)
        this.students = response.data.students
      } catch (error) {
        console.error('Error loading students:', error)
        this.$toasted.error('Failed to load students')
      } finally {
        this.loading = false
      }
    },

    async loadStatistics() {
      try {
        const params = new URLSearchParams(this.filters)
        const response = await Nova.request().get(`/api/attendance/statistics?${params}`)
        this.statistics = response.data
      } catch (error) {
        console.error('Error loading statistics:', error)
      }
    },

    applyFilters() {
      this.loadStudents()
      this.loadStatistics()
    },

    resetFilters() {
      this.filters = {
        year: '',
        date_from: '',
        date_to: '',
        min_sessions: '',
        max_sessions: '',
        min_locations: '',
        max_locations: '',
      }
      this.applyFilters()
    },

    toggleStudent(studentId) {
      const index = this.expandedStudents.indexOf(studentId)
      if (index > -1) {
        this.expandedStudents.splice(index, 1)
      } else {
        this.expandedStudents.push(studentId)
      }
    },

    exportCohortPDF() {
      const detailLevel = prompt('Select detail level:\n1. Summary\n2. Detailed\n3. Comparison\n\nEnter 1, 2, or 3:', '1')
      const levels = { '1': 'summary', '2': 'detailed', '3': 'comparison' }
      const params = new URLSearchParams({
        ...this.filters,
        detail_level: levels[detailLevel] || 'summary'
      })
      window.location.href = `/api/attendance/export-cohort-pdf?${params}`
    },

    exportCSV() {
      const params = new URLSearchParams(this.filters)
      window.location.href = `/api/attendance/export-csv?${params}`
    },

    formatDate(dateString) {
      if (!dateString) return ''
      const date = new Date(dateString)
      return date.toLocaleDateString('en-GB', { 
        day: '2-digit', 
        month: 'short', 
        year: 'numeric' 
      })
    },

    renderSignature(pathData) {
      if (!pathData) return ''
      
      // Check if it's already a complete SVG element
      if (pathData.trim().startsWith('<svg')) {
        return pathData
      }
      
      // Otherwise, wrap the path data in an SVG element
      return `<svg width="300" height="150" viewBox="0 0 300 150" xmlns="http://www.w3.org/2000/svg">
        <path d="${pathData}" stroke="black" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`
    },
  },
}
</script>

<style scoped>
.bg-primary-500 {
  background-color: #005e7e;
}

.signature-display {
  max-width: 100%;
  height: auto;
  min-height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.signature-display svg {
  max-width: 100%;
  height: auto;
  max-height: 100px;
}
</style>
