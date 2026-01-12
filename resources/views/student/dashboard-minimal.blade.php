@extends('layouts.student')

@section('title', 'Student Dashboard - Student Result System')

@section('styles')
<style>
.sidebar-item {
    transition: all 0.2s ease;
}
.sidebar-item:hover {
    background-color: #f0f9ff;
}
.sidebar-item.active {
    background-color: #4B8EF2;
    color: white;
}
.card {
    transition: all 0.2s ease;
}
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 142, 242, 0.15);
}
</style>
@endsection

@section('content')
<div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200">
        <div class="p-6 bg-[#4B8EF2]">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-[#4B8EF2]"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-white">Student Panel</h2>
                    <p class="text-blue-100 text-sm">{{ $student->full_name ?? 'Student' }}</p>
                </div>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('student.dashboard') }}" class="sidebar-item active flex items-center px-6 py-3 text-white">
                <i class="fas fa-user w-5 h-5 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('student.profile') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700">
                <i class="fas fa-user w-5 h-5 mr-3"></i>
                <span>My Profile</span>
            </a>
            <a href="{{ route('student.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                <span>My Results</span>
            </a>
            
            <div class="border-t border-gray-200 mt-6 pt-6">
                <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Top Navigation -->
        <header class="bg-white border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Student Dashboard</h1>
                    <p class="text-sm text-gray-500">Welcome back, {{ $student->first_name ?? 'Student' }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ $student->full_name ?? 'Student' }}</p>
                        <p class="text-xs text-gray-500">{{ $student->email }}</p>
                    </div>
                    <div class="w-10 h-10 bg-[#4B8EF2] rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">{{ substr($student->first_name ?? 'S', 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="card bg-white rounded-lg shadow p-6 border-l-4 border-[#4B8EF2]">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-user text-[#4B8EF2]"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Student ID</p>
                            <p class="text-xl font-bold text-gray-900">{{ $student->student_id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card bg-white rounded-lg shadow p-6 border-l-4 border-[#4B8EF2]">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-chart-bar text-[#4B8EF2]"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Results</p>
                            <p class="text-xl font-bold text-gray-900">{{ isset($student->results) ? $student->results->count() : 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Profile Information -->
                <div class="card bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-[#4B8EF2] p-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Profile Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Full Name</span>
                                <span class="font-medium text-gray-900">{{ $student->full_name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Email</span>
                                <span class="font-medium text-gray-900">{{ $student->email }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Phone</span>
                                <span class="font-medium text-gray-900">{{ $student->phone ?? 'Not provided' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-200">
                                <span class="text-gray-600">Date of Birth</span>
                                <span class="font-medium text-gray-900">{{ $student->date_of_birth ? $student->date_of_birth->format('M d, Y') : 'Not provided' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600">Status</span>
                                <span class="px-3 py-1 text-xs rounded-full bg-[#4B8EF2] text-white">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Results -->
                <div class="card bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-[#4B8EF2] p-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-chart-line mr-2"></i>
                            Recent Results
                        </h3>
                    </div>
                    <div class="p-6">
                        @if(isset($student->results) && $student->results->count() > 0)
                            <div class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach($student->results->take(5) as $result)
                                    <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-[#4B8EF2]">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $result->exam_type ?? 'Exam' }}</p>
                                                <p class="text-sm text-gray-600">Course: {{ $result->course ? $result->course->course_name : 'N/A' }}</p>
                                                <div class="flex items-center space-x-4 mt-2">
                                                    <span class="text-sm font-medium text-[#4B8EF2]">Score: {{ $result->marks ?? 'N/A' }}/{{ $result->total_marks ?? 'N/A' }}</span>
                                                    <span class="text-sm font-medium text-[#4B8EF2]">Grade: {{ $result->grade ?? 'N/A' }}</span>
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
                                    <a href="{{ route('student.results') }}" class="text-[#4B8EF2] hover:text-[#3d7be8] font-medium">
                                        View All Results <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-chart-bar text-5xl text-gray-300 mb-4"></i>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No Results Available</h4>
                                <p class="text-gray-500">Results will appear here when your admin adds them.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('student.profile') }}" class="block w-full bg-[#4B8EF2] text-white py-3 px-4 rounded-lg hover:bg-[#3d7be8] transition duration-200 text-center font-medium">
                            <i class="fas fa-user mr-2"></i> View Full Profile
                        </a>
                        <a href="{{ route('student.results') }}" class="block w-full bg-[#4B8EF2] text-white py-3 px-4 rounded-lg hover:bg-[#3d7be8] transition duration-200 text-center font-medium">
                            <i class="fas fa-chart-line mr-2"></i> View All Results
                        </a>
                    </div>
                </div>
                
                <div class="card bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Info</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Login:</span>
                            <span class="text-gray-900">{{ now()->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Account Status:</span>
                            <span class="text-[#4B8EF2] font-medium">Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
