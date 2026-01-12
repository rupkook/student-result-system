@extends('layouts.student')

@section('title', 'Student Dashboard - Test')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Student Dashboard</h1>
        
        @if(isset($student))
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Welcome, {{ $student->full_name ?? 'Student' }}!</h2>
                <p class="text-gray-600">Email: {{ $student->email }}</p>
                <p class="text-gray-600">Student ID: {{ $student->student_id ?? 'N/A' }}</p>
                
                @if(isset($student->results) && $student->results->count() > 0)
                    <h3 class="text-lg font-semibold mt-6 mb-3">Your Results:</h3>
                    @foreach($student->results as $result)
                        <div class="border rounded p-3 mb-2">
                            <p><strong>{{ $result->exam_type ?? 'Exam' }}</strong></p>
                            <p>Score: {{ $result->score ?? 'N/A' }}</p>
                            <p>Grade: {{ $result->grade ?? 'N/A' }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 mt-4">No results available yet.</p>
                @endif
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Error:</strong> Student data not available.
            </div>
        @endif
        
        <div class="mt-6">
            <a href="{{ route('logout') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Logout
            </a>
        </div>
    </div>
</div>
@endsection
