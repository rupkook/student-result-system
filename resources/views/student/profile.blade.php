@extends('layouts.student')

@section('title', 'Student Profile - Student Result System')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/student.css') }}">
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg animate-slide-in">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Student Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('student.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('student.profile') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-user w-5 h-5 mr-3"></i>
                Profile
            </a>
            <a href="{{ route('student.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8">
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
                <h1 class="text-2xl font-semibold text-gray-800">Student Profile</h1>
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">{{ auth()->user()->first_name }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Profile Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="max-w-6xl mx-auto">
                <!-- Personal Information Section -->
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                    <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                        <div class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user text-blue-600 mr-3"></i>
                            Personal Information
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Full Name</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Email Address</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Date of Birth</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->date_of_birth ? auth()->user()->date_of_birth->format('M d, Y') : 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Gender</p>
                            <p class="font-semibold text-gray-800">{{ ucfirst(auth()->user()->gender ?? 'Not specified') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Student ID</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->student_id ?? 'Not assigned' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address Information Section -->
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                    <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                        <div class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-map-marker-alt text-green-600 mr-3"></i>
                            Address Information
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Street Address</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->address ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">City</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->city ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Division/State</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->division ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Zip Code</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->zip_code ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Country</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->country ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Academic Information Section -->
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                    <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                        <div class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-graduation-cap text-purple-600 mr-3"></i>
                            Academic Information
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Course</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->course ?? 'Not assigned' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Admission Date</p>
                            <p class="font-semibold text-gray-800">{{ auth()->user()->admission_date ? (is_string(auth()->user()->admission_date) ? auth()->user()->admission_date : auth()->user()->admission_date->format('M d, Y')) : 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Status</p>
                            <span class="px-3 py-1 text-sm rounded-full font-medium {{ auth()->user()->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst(auth()->user()->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                        <div class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-chart-line text-orange-600 mr-3"></i>
                            Academic Results
                        </div>
                    </div>
                    @if(auth()->user()->results && auth()->user()->results->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach(auth()->user()->results as $result)
                                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-semibold text-gray-800">{{ $result->exam_type ?? 'Exam' }}</h4>
                                        <span class="text-xs text-gray-500">{{ $result->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Course:</span>
                                            <span class="text-sm font-medium">{{ $result->course ? $result->course->course_name : 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Score:</span>
                                            <span class="text-sm font-semibold text-blue-600">{{ $result->marks ?? 'N/A' }}/{{ $result->total_marks ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Grade:</span>
                                            <span class="text-sm font-semibold {{ $result->grade == 'A' ? 'text-green-600' : ($result->grade == 'B' ? 'text-blue-600' : ($result->grade == 'C' ? 'text-yellow-600' : 'text-red-600')) }}">
                                                {{ $result->grade ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-chart-bar w-20 h-20 mx-auto text-gray-400 mb-6"></i>
                            <h4 class="text-2xl font-semibold text-gray-600 mb-3">No Results Available</h4>
                            <p class="text-gray-500 mb-2">Your results section is currently empty.</p>
                            <p class="text-sm text-gray-400">Results will appear here when your admin adds them.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
