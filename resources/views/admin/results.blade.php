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
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 bg-red-50 border-l-4 border-red-600 transition-all duration-200">
                <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Manage Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8 transition-all duration-200">
                <svg class="w-5 h-5 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
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
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Publish New Result
                    </button>
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">AD</span>
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
                            <input type="text" id="searchInput" placeholder="Search by student name..." class="form-input pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64" onkeyup="searchResults()">
                            <i class="fas fa-search-location w-5 h-5 text-gray-400 absolute left-3 top-2.5"></i>
                        </div>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marks</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GPA</th>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->course ? $result->course->course_name : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->exam_type ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->marks ?? 'N/A' }}/100</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $result->grade ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->gpa ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Published</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->exam_date ? $result->exam_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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
    console.log('Searching for student ID:', studentId);
    
    if (studentId.trim() === '') {
        document.getElementById('student_name').value = '';
        return;
    }
    
    fetch(`/admin/students/search/${studentId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Student search response:', data);
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

// Search results with debounce
let searchTimeout;
function searchResults() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        filterResults();
    }, 300); // Wait 300ms after user stops typing
}

function filterResults() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const tableRows = document.querySelectorAll('#resultsTableBody tr');
    
    tableRows.forEach(row => {
        const studentName = row.cells[2]?.textContent.toLowerCase() || '';
        const studentId = row.cells[1]?.textContent.toLowerCase() || '';
        const course = row.cells[3]?.textContent.toLowerCase() || '';
        const grade = row.cells[6]?.textContent.toLowerCase() || '';
        
        const matchesSearch = searchValue === '' || 
            studentName.includes(searchValue) || 
            studentId.includes(searchValue) || 
            course.includes(searchValue) || 
            grade.includes(searchValue);
        
        row.style.display = matchesSearch ? '' : 'none';
    });
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
