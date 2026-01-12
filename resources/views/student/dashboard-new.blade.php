@extends('layouts.student')

@section('title', 'Student Dashboard - Student Result System')

@section('styles')
<style>
.sidebar-item {
    transition: all 0.3s ease;
}
.sidebar-item:hover {
    transform: translateX(5px);
}
.sidebar-item.active {
    background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);
    color: white;
}
.card-hover {
    transition: all 0.3s ease;
}
.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>
@endsection

@section('content')
<div class="flex h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-2xl">
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-600">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-user text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">Student Panel</h2>
                    <p class="text-blue-100 text-sm">{{ $student->full_name ?? 'Student' }}</p>
                </div>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('student.dashboard') }}" class="sidebar-item active flex items-center px-6 py-3 text-white hover:text-white">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('student.profile') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                <i class="fas fa-user w-5 h-5 mr-3"></i>
                <span class="font-medium">My Profile</span>
            </a>
            <a href="{{ route('student.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                <span class="font-medium">My Results</span>
            </a>
            
            <div class="border-t border-gray-200 mt-6 pt-6">
                <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Student Dashboard</h1>
                    <p class="text-sm text-gray-500">Welcome back, {{ $student->first_name ?? 'Student' }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ $student->full_name ?? 'Student' }}</p>
                        <p class="text-xs text-gray-500">{{ $student->email }}</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-sm font-bold">{{ substr($student->first_name ?? 'S', 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-user text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Student ID</p>
                            <p class="text-xl font-bold text-gray-800">{{ $student->student_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Department</p>
                            <p class="text-xl font-bold text-gray-800">{{ $student->department ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Results</p>
                            <p class="text-xl font-bold text-gray-800">{{ isset($student->results) ? $student->results->count() : 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Profile Information -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Profile Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="text-gray-600">Full Name</span>
                                <span class="font-medium text-gray-800">{{ $student->full_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="text-gray-600">Email</span>
                                <span class="font-medium text-gray-800">{{ $student->email }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="text-gray-600">Phone</span>
                                <span class="font-medium text-gray-800">{{ $student->phone ?? 'Not provided' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="text-gray-600">Date of Birth</span>
                                <span class="font-medium text-gray-800">{{ $student->date_of_birth ? $student->date_of_birth->format('M d, Y') : 'Not provided' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b">
                                <span class="text-gray-600">Gender</span>
                                <span class="font-medium text-gray-800">{{ ucfirst($student->gender ?? 'Not specified') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Status</span>
                                <span class="px-3 py-1 text-xs rounded-full {{ $student->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Results -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 p-4">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-chart-line mr-2"></i>
                            Recent Results
                        </h3>
                    </div>
                    <div class="p-6">
                        @if(isset($student->results) && $student->results->count() > 0)
                            <div class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach($student->results->take(5) as $result)
                                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $result->exam_type ?? 'Exam' }}</p>
                                                <p class="text-sm text-gray-600">Course: {{ $result->course ? $result->course->course_name : 'N/A' }}</p>
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span class="text-sm font-medium text-blue-600">Score: {{ $result->marks ?? 'N/A' }}/{{ $result->total_marks ?? 'N/A' }}</span>
                                                    <span class="text-sm font-medium text-green-600">Grade: {{ $result->grade ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs text-gray-500">{{ $result->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($student->results->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('student.results') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        View All Results <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-chart-bar text-6xl text-gray-300 mb-4"></i>
                                <h4 class="text-xl font-semibold text-gray-600 mb-2">No Results Available</h4>
                                <p class="text-gray-500 mb-1">Your results section is currently empty.</p>
                                <p class="text-sm text-gray-400">Results will appear here when your admin adds them.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card-hover bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('student.profile') }}" class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 text-center font-medium">
                            <i class="fas fa-user mr-2"></i> View Full Profile
                        </a>
                        <a href="{{ route('student.results') }}" class="block w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 text-center font-medium">
                            <i class="fas fa-chart-line mr-2"></i> View All Results
                        </a>
                    </div>
                </div>
                
                <div class="card-hover bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">System Info</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Login:</span>
                            <span class="text-gray-800">{{ now()->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Account Status:</span>
                            <span class="text-green-600 font-medium">Active</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">System Version:</span>
                            <span class="text-gray-800">v1.0.0</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
