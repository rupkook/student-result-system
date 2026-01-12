@extends('layouts.student')

@section('title', 'Student Results - Student Result System')

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
            <a href="{{ route('student.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-blue-600 bg-blue-50 text-blue-600">
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
                <h1 class="text-2xl font-semibold text-gray-800">Your Results</h1>
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">{{ auth()->user()->first_name }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Results Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1">
                            <!-- Results Section -->
                            <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                                <h3 class="font-semibold text-green-800 mb-4 text-lg">Your Results</h3>
                                @if(auth()->user()->results->count() > 0)
                                    <div class="space-y-3 max-h-64 overflow-y-auto">
                                        @foreach(auth()->user()->results as $result)
                                            <div class="bg-white p-4 rounded-lg border border-green-200 shadow-sm">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <p class="font-medium text-gray-800">{{ $result->exam_type ?? 'Exam' }}</p>
                                                        <p class="text-sm text-gray-600">Score: <span class="font-semibold">{{ $result->marks ?? 'N/A' }}/{{ $result->total_marks ?? 'N/A' }}</span></p>
                                                        <p class="text-sm text-gray-600">Grade: <span class="font-semibold">{{ $result->grade ?? 'N/A' }}</span></p>
                                                        <p class="text-sm text-gray-600">Course: <span class="font-semibold">{{ $result->course ? $result->course->course_name : 'N/A' }}</span></p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-xs text-gray-500">{{ $result->created_at->format('M d, Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="fas fa-chart-bar w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                                        <h4 class="text-xl font-semibold text-gray-600 mb-2">No Results Available</h4>
                                        <p class="text-gray-500 mb-1">Your results section is currently empty.</p>
                                        <p class="text-sm text-gray-400">Results will appear here when your admin adds them.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
