@extends('layouts.admin')

@section('title', 'Manage Results - Admin Panel')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg border-r border-gray-200">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-shield text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-user-graduate w-5 h-5 mr-3"></i>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 bg-red-50 border-l-4 border-red-600 transition-all duration-200">
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
                <h1 class="text-2xl font-semibold text-gray-800">Manage Results</h1>
                <div class="flex items-center space-x-4">
                    <button onclick="openPublishResultModal()" class="btn-transition bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 flex items-center">
                        <i class="fas fa-plus-circle w-4 h-4 mr-2"></i>
                        Publish New Result
                    </button>
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Results Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search results..." class="form-input pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64">
                            <i class="fas fa-search-location w-5 h-5 text-gray-400 absolute left-3 top-2.5"></i>
                        </div>
                        <select id="courseFilter" class="form-input px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">All Courses</option>
                            <option>MERN Stack</option>
                            <option>Web App Dev</option>
                            <option>UI/UX</option>
                            <option>Python</option>
                            <option>Graphic Design</option>
                            <option>Motion Design</option>
                            <option>Video Editing</option>
                            <option>Digital Marketing</option>
                            <option>Cybersecurity</option>
                            <option>Data Science</option>
                            <option>Networking</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table-hover min-w-full divide-y divide-gray-200" id="resultsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" class="rounded border-gray-300">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="resultsTableBody">
                            @if(isset($results) && $results->count() > 0)
                                @foreach($results as $result)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-gray-300">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $result->student->student_id ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->student->first_name . ' ' . $result->student->last_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->subject ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->exam_type ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $result->score ?? 'N/A' }}/100</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $result->grade ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Published</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editResult({{ $result->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button onclick="deleteResult({{ $result->id }})" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="px-6 py-8 text-center">
                                        <div class="text-center">
                                            <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                            <h4 class="text-lg font-semibold text-gray-600 mb-2">No Results Available</h4>
                                            <p class="text-gray-500 mb-1">No results have been published yet.</p>
                                            <p class="text-sm text-gray-400">Click "Publish New Result" to add your first result.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Publish Result Modal -->
<div id="publishResultModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full z-50 hidden">
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Publish New Result</h3>
                <button onclick="closePublishResultModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form id="publishResultForm" action="{{ route('admin.results.publish') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <!-- Student ID Input -->
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">Student ID</label>
                        <input type="text" id="student_id" name="student_id" required
                               class="form-input"
                               placeholder="Enter Student ID (e.g., STU0001)"
                               onchange="fetchStudentInfo(this.value)">
                    </div>
                    
                    <!-- Student Name (Auto-populated) -->
                    <div>
                        <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="student_name" name="student_name" readonly
                               class="form-input bg-gray-100"
                               placeholder="Student name will appear here">
                    </div>
                    
                    <!-- Course Selection -->
                    <div>
                        <label for="course" class="block text-sm font-medium text-gray-700 mb-2">Course</label>
                        <select id="course" name="course" required class="form-input">
                            <option value="">Select Course</option>
                            <option>MERN Stack</option>
                            <option>Web App Dev</option>
                            <option>UI/UX</option>
                            <option>Python</option>
                            <option>Graphic Design</option>
                            <option>Motion Design</option>
                            <option>Video Editing</option>
                            <option>Digital Marketing</option>
                            <option>Cybersecurity</option>
                            <option>Data Science</option>
                            <option>Networking</option>
                        </select>
                    </div>
                    
                    <!-- Scores Input -->
                    <div>
                        <label for="score" class="block text-sm font-medium text-gray-700 mb-2">Scores</label>
                        <input type="number" id="score" name="score" required
                               class="form-input"
                               placeholder="Enter score (0-100)"
                               min="0" max="100">
                    </div>
                    
                    <!-- Grades Input -->
                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700 mb-2">Grades</label>
                        <select id="grade" name="grade" required class="form-input">
                            <option value="">Select Grade</option>
                            <option value="A+">A+</option>
                            <option value="A">A</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="B-">B-</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="C-">C-</option>
                            <option value="D+">D+</option>
                            <option value="D">D</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    
                </div>
                
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closePublishResultModal()" 
                            class="btn-transition px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn-transition bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        <i class="fas fa-save mr-2"></i>
                        Publish Result
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Modal functions
function openPublishResultModal() {
    document.getElementById('publishResultModal').classList.remove('hidden');
}

function closePublishResultModal() {
    document.getElementById('publishResultModal').classList.add('hidden');
    document.getElementById('publishResultForm').reset();
    document.getElementById('student_name').value = '';
}

// Fetch student info when student ID is entered
function fetchStudentInfo(studentId) {
    if (studentId.trim() === '') {
        document.getElementById('student_name').value = '';
        return;
    }
    
    fetch(`/admin/students/search/${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Combine first_name and last_name for full name
                const fullName = data.student.first_name + ' ' + data.student.last_name;
                document.getElementById('student_name').value = fullName;
                document.getElementById('student_name').classList.remove('text-red-500');
            } else {
                document.getElementById('student_name').value = 'Student not found';
                document.getElementById('student_name').classList.add('text-red-500');
            }
        })
        .catch(error => {
            console.error('Error fetching student info:', error);
            document.getElementById('student_name').value = 'Error loading student info';
            document.getElementById('student_name').classList.add('text-red-500');
        });
}

// Search results
function searchResults() {
    const searchValue = document.getElementById('searchInput').value;
    const courseFilter = document.getElementById('courseFilter').value;
    const examFilter = document.getElementById('examFilter').value;
    
    const url = new URL('/admin/results', window.location.origin);
    if (searchValue) url.searchParams.set('search', searchValue);
    if (courseFilter) url.searchParams.set('course', courseFilter);
    if (examFilter) url.searchParams.set('exam', examFilter);
    
    window.location.href = url.toString();
}

// Edit result (placeholder)
function editResult(id) {
    // TODO: Implement edit functionality
    alert('Edit functionality coming soon for result ID: ' + id);
}

// Delete result (placeholder)
function deleteResult(id) {
    if (confirm('Are you sure you want to delete this result?')) {
        fetch(`/admin/results/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting result: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error deleting result:', error);
            alert('Error deleting result');
        });
    }
}
</script>
@endsection
