<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Load the authenticated student with their results
        $student = Auth::user();
        $student = Student::with('results')->find($student->id); // Eager load results
        
        return view('student.dashboard', compact('student'));
    }

    public function profile()
    {
        // Load the authenticated student with their results
        $student = Auth::user();
        $student = Student::with('results')->find($student->id); // Eager load results
        
        return view('student.profile', compact('student'));
    }

    public function results()
    {
        // Load the authenticated student with their results
        $student = Auth::user();
        $student = Student::with('results')->find($student->id); // Eager load results
        
        return view('student.results', compact('student'));
    }
}
