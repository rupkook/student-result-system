@extends('layouts.admin')

@section('title', 'Admin Dashboard - Student Result System')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg border-r border-gray-200 animate-slide-in">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-shield text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 bg-red-50 border-l-4 border-red-600 transition-all duration-200">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-user-graduate w-5 h-5 mr-3"></i>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                Manage Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8 transition-all duration-200">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Navbar -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-800">Admin Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <button class="btn-transition bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        Add New Student
                    </button>
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">AD</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="card-hover bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Students</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_students'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Courses</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_courses'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m3-2h6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Results Published</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $stats['published_results'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Avg. Performance</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['avg_performance'], 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Recent Students -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Recent Student Registrations</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @if(isset($stats['recent_students']) && $stats['recent_students']->count() > 0)
                                @foreach($stats['recent_students'] as $student)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-medium">{{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $student->first_name }} {{ $student->last_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $student->student_id }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $student->created_at ? $student->created_at->diffForHumans() : 'Recently' }}</span>
                                </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No recent student registrations</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Results -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Recent Result Publications</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @if(isset($stats['recent_results']) && $stats['recent_results']->count() > 0)
                                @foreach($stats['recent_results'] as $result)
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $result->course ? $result->course->course_name : 'Unknown Course' }} - {{ $result->exam_type }}</p>
                                        <p class="text-xs text-gray-500">{{ $result->student ? $result->student->first_name . ' ' . $result->student->last_name : 'Unknown Student' }}</p>
                                    </div>
                                    <span class="badge-success">{{ $result->status }}</span>
                                </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No recent result publications</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions and Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('admin.students.create') }}" class="btn-transition p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Add Student</p>
                            </a>
                            <a href="{{ route('admin.results') }}" class="btn-transition p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m3-2h6"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Publish Result</p>
                            </a>
                            <button onclick="generateReport()" class="btn-transition p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Generate Report</p>
                            </button>
                            <button onclick="exportData()" class="btn-transition p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <p class="text-sm text-gray-600">Export Data</p>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Distribution Chart -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Course Distribution</h3>
                    </div>
                    <div class="p-6">
                        <canvas id="courseChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grade Distribution Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Grade Distribution</h3>
                </div>
                <div class="p-6">
                    <canvas id="gradeChart" width="400" height="100"></canvas>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Course Distribution Chart
const courseCtx = document.getElementById('courseChart').getContext('2d');
const courseChart = new Chart(courseCtx, {
    type: 'doughnut',
    data: {
        labels: @json($courseStats->pluck('course_name')),
        datasets: [{
            data: @json($courseStats->pluck('results_count')),
            backgroundColor: [
                '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6',
                '#EC4899', '#14B8A6', '#F97316', '#6366F1', '#84CC16'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 12
                    }
                }
            }
        }
    }
});

// Grade Distribution Chart
const gradeCtx = document.getElementById('gradeChart').getContext('2d');
const gradeChart = new Chart(gradeCtx, {
    type: 'bar',
    data: {
        labels: @json($gradeStats->pluck('grade')),
        datasets: [{
            label: 'Number of Students',
            data: @json($gradeStats->pluck('count')),
            backgroundColor: '#3B82F6',
            borderColor: '#2563EB',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Quick Actions Functions
function generateReport() {
    alert('Report generation feature coming soon!');
}

function exportData() {
    alert('Data export feature coming soon!');
}
</script>
@endsection
