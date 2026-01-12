@extends('layouts.admin')

@section('title', 'Manage Results - Admin Panel')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600 border-l-4 border-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m3-2h6"></path>
                </svg>
                Manage Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <!-- Search and Filter -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Search results..." class="form-input pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <select class="form-input px-3 py-2 border border-gray-300 rounded-md">
                            <option>All Courses</option>
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
                        <select class="form-input px-3 py-2 border border-gray-300 rounded-md">
                            <option>All Exam Types</option>
                            <option>Final Exam</option>
                            <option>Mid Term</option>
                            <option>Quiz</option>
                            <option>Assignment</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="btn-transition px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table-hover min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" class="rounded border-gray-300">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($results as $result)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $result->student->student_id ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->student->full_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $result->subject ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->exam_type ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $result->score ?? 'N/A' }}/100</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $result->grade ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="badge-success">Published</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $result->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editResult({!! $result->id !!})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    <button onclick="deleteResult({!! $result->id !!})" class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                        <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">892</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-red-50 text-sm font-medium text-red-600">1</button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                                <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Publish Result Modal (Hidden by default) -->
<div id="publishResultModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Publish New Result</h3>
            <form action="{{ route('admin.results.publish') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Student ID</label>
                    <input type="text" name="student_id" required
                           class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                           placeholder="Enter student ID">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Student Name</label>
                    <input type="text" name="student_name" readonly
                           class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"
                           placeholder="Will auto-populate when student ID is entered">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" required
                           class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                           placeholder="Enter subject name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Exam Type</label>
                    <select name="exam_type" required class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="Final Exam">Final Exam</option>
                        <option value="Mid Term">Mid Term</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Assignment">Assignment</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Score</label>
                    <input type="number" name="score" required min="0" max="100"
                           class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md"
                           placeholder="Enter score (0-100)">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Grade</label>
                    <select name="grade" required class="form-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
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
                <div class="flex items-center">
                    <input type="checkbox" id="publishImmediately" name="publish_immediately" value="1" class="rounded border-gray-300">
                    <label for="publishImmediately" class="ml-2 block text-sm text-gray-900">
                        Publish immediately after creation
                    </label>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closePublishResultModal()" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Publish Result</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPublishResultModal() {
    document.getElementById('publishResultModal').classList.remove('hidden');
}

function closePublishResultModal() {
    document.getElementById('publishResultModal').classList.add('hidden');
}

// Auto-populate student name when student ID is entered
document.addEventListener('DOMContentLoaded', function() {
    const studentIdInput = document.querySelector('input[name="student_id"]');
    const studentNameInput = document.querySelector('input[name="student_name"]');
    
    if (studentIdInput && studentNameInput) {
        studentIdInput.addEventListener('input', function() {
            const studentId = this.value.trim();
            if (studentId.length > 0) {
                // Fetch student info from database
                fetch(`/admin/students/search?id=${studentId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            studentNameInput.value = data.student.full_name;
                        } else {
                            studentNameInput.value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching student:', error);
                        studentNameInput.value = '';
                    });
            } else {
                studentNameInput.value = '';
            }
        });
    }
});

// Edit result function
function editResult(resultId) {
    if (confirm('Are you sure you want to edit this result?')) {
        window.location.href = `/admin/results/${resultId}/edit`;
    }
}

// Delete result function
function deleteResult(resultId) {
    if (confirm('Are you sure you want to delete this result? This action cannot be undone.')) {
        fetch(`/admin/results/${resultId}/delete`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            console.error('Error:', error);
            alert('Error deleting result');
        });
    }
}
</script>
@endsection
