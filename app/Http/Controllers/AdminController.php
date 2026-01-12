<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_students' => Student::count(),
            'active_students' => Student::where('status', 'active')->count(),
            'total_results' => Result::count(),
            'published_results' => Result::where('status', 'published')->count(),
            'recent_students' => Student::latest()->take(5)->get(),
            'recent_activities' => Result::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function students()
    {
        $students = Student::paginate(10);
        $departments = ['mernstack', 'Web app development (full-stack)', 'UIUX', 'Python Programing', 'Graphic Design', 'Motion Design', 'Vedio Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'];
        
        return view('admin.students', compact('students', 'departments'));
    }

    public function results()
    {
        $results = Result::with('student')->paginate(10);
        return view('admin.results', compact('results'));
    }

    public function showAddStudentForm()
    {
        $departments = ['mernstack', 'Web app development (full-stack)', 'UIUX', 'Python Programing', 'Graphic Design', 'Motion Design', 'Vedio Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'];
        return view('admin.add-student', compact('departments'));
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'department' => 'required|in:mernstack,Web app development (full-stack),UIUX,Python Programing,Graphic Design,Motion Design,Vedio Editing,Digital Marketing,Cybersecurity,Data Science,Networking',
            'admission_date' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Generate unique student ID
        $lastStudent = Student::orderBy('id', 'desc')->first();
        $lastNumber = $lastStudent ? (int)substr($lastStudent->student_id, 3) : 0;
        $newNumber = $lastNumber + 1;
        $studentId = 'STU' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $student = Student::create([
            'student_id' => $studentId,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'department' => $validated['department'],
            'password' => Hash::make($validated['password']),
            'status' => 'active',
        ]);

        return redirect()->route('admin.admin.students')
            ->with('success', "Student created successfully! Student ID: {$studentId}");
    }

    public function editStudent($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
        return response()->json($student);
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:255',
            'department' => 'required|in:mernstack,Web app development (full-stack),UIUX,Python Programing,Graphic Design,Motion Design,Vedio Editing,Digital Marketing,Cybersecurity,Data Science,Networking',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        // Don't allow updating student_id - it's auto-generated
        $student->update($validated);

        return response()->json(['success' => true, 'message' => 'Student updated successfully!']);
    }

    public function deleteStudent($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['success' => true, 'message' => 'Student deleted successfully!']);
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:20|unique:courses',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'credits' => 'required|integer|min:1|max:10',
            'department' => 'required|string|max:100',
            'semester' => 'required|string|max:50',
            'instructor' => 'required|string|max:255',
            'max_students' => 'required|integer|min:1|max:200',
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses')->with('success', 'Course added successfully!');
    }

    public function publishResult(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'exam_type' => 'required|string|max:100',
            'marks' => 'required|numeric|min:0|max:100',
            'total_marks' => 'required|numeric|min:1|max:100',
            'exam_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        $marks = $validated['marks'];
        $totalMarks = $validated['total_marks'];
        $percentage = ($marks / $totalMarks) * 100;
        
        $grade = $this->calculateGrade($percentage);
        $gpa = $this->calculateGPA($grade);

        Result::create([
            'student_id' => $validated['student_id'],
            'course_id' => $validated['course_id'],
            'exam_type' => $validated['exam_type'],
            'marks' => $marks,
            'total_marks' => $totalMarks,
            'grade' => $grade,
            'gpa' => $gpa,
            'status' => 'published',
            'exam_date' => $validated['exam_date'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('admin.results')->with('success', 'Result published successfully!');
    }

    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 85) return 'A';
        if ($percentage >= 80) return 'B+';
        if ($percentage >= 75) return 'B';
        if ($percentage >= 70) return 'C+';
        if ($percentage >= 65) return 'C';
        if ($percentage >= 60) return 'D';
        return 'F';
    }

    private function calculateGPA($grade)
    {
        $gpaMap = [
            'A+' => 4.0,
            'A' => 3.8,
            'B+' => 3.5,
            'B' => 3.2,
            'C+' => 2.8,
            'C' => 2.5,
            'D' => 2.0,
            'F' => 0.0,
        ];

        return $gpaMap[$grade] ?? 0.0;
    }
}
