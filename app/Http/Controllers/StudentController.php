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
        try {
            // Load the authenticated student with their results
            $student = Auth::user();
            if (!$student) {
                return redirect()->route('login');
            }
            
            $student = Student::with('results')->find($student->id); // Eager load results
            
            return view('student.dashboard-minimal', compact('student'));
        } catch (\Exception $e) {
            // Log the error and return a simple view
            return view('student.dashboard', ['student' => Auth::user()]);
        }
    }

    public function profile()
    {
        try {
            // Load the authenticated student with their results
            $student = Auth::user();
            if (!$student) {
                return redirect()->route('login');
            }
            
            $student = Student::with('results')->find($student->id); // Eager load results
            
            return view('student.profile', compact('student'));
        } catch (\Exception $e) {
            return view('student.profile', ['student' => Auth::user()]);
        }
    }

    public function results()
    {
        try {
            // Load the authenticated student with their results
            $student = Auth::user();
            if (!$student) {
                return redirect()->route('login');
            }
            
            $student = Student::with('results')->find($student->id); // Eager load results
            
            return view('student.results', compact('student'));
        } catch (\Exception $e) {
            return view('student.results', ['student' => Auth::user()]);
        }
    }
}
