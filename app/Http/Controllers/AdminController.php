<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        $courses = ['MERN Stack', 'Web App Dev', 'UI/UX', 'Python', 'Graphic Design', 'Motion Design', 'Video Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'];
        
        return view('admin.students', compact('students', 'courses'));
    }

    public function results()
    {
        $results = Result::with('student')->paginate(10);
        return view('admin.results', compact('results'));
    }

    public function showAddStudentForm()
    {
        $courses = ['MERN Stack', 'Web App Dev', 'UI/UX', 'Python', 'Graphic Design', 'Motion Design', 'Video Editing', 'Digital Marketing', 'Cybersecurity', 'Data Science', 'Networking'];
        return view('admin.add-student', compact('courses'));
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
            'course' => 'required|in:MERN Stack,Web App Dev,UI/UX,Python,Graphic Design,Motion Design,Video Editing,Digital Marketing,Cybersecurity,Data Science,Networking',
            'admission_date' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'division' => 'required|string|max:255',
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
            'city' => $validated['city'],
            'division' => $validated['division'],
            'zip_code' => $validated['zip_code'],
            'country' => $validated['country'],
            'course' => $validated['course'],
            'admission_date' => $validated['admission_date'],
            'password' => Hash::make($validated['password']),
            'status' => 'active',
        ]);

        return redirect()->route('admin.students')
            ->with('success', "Student created successfully! Student ID: {$studentId}");
    }

    public function editStudent($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Student not found'], 404);
        }
        
        // Format dates properly for JSON response
        $studentArray = $student->toArray();
        if ($studentArray['date_of_birth']) {
            $studentArray['date_of_birth'] = $student->date_of_birth->format('Y-m-d');
        }
        if ($studentArray['admission_date']) {
            $studentArray['admission_date'] = $student->admission_date->format('Y-m-d');
        }
        
        return response()->json($studentArray);
    }

    public function updateStudent(Request $request, $id)
    {
        try {
            \Log::info('Update student request for ID: ' . $id);
            \Log::info('Request data: ', $request->all());
            
            $student = Student::find($id);
            if (!$student) {
                \Log::error('Student not found with ID: ' . $id);
                return response()->json(['success' => false, 'message' => 'Student not found'], 404);
            }

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'course' => 'required|in:MERN Stack,Web App Dev,UI/UX,Python,Graphic Design,Motion Design,Video Editing,Digital Marketing,Cybersecurity,Data Science,Networking',
                'admission_date' => 'required|date',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'division' => 'required|string|max:255',
                'zip_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
                'status' => 'required|in:active,inactive,suspended',
            ]);

            \Log::info('Validated data: ', $validated);

            // Don't allow updating student_id - it's auto-generated
            $student->update($validated);

            \Log::info('Student updated successfully');
            return response()->json(['success' => true, 'message' => 'Student updated successfully!']);
            
        } catch (\Exception $e) {
            \Log::error('Update student error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating student: ' . $e->getMessage()]);
        }
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

    public function searchStudent($student_id)
    {
        $student = Student::where('student_id', $student_id)->first();
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function publishResult(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'student_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        // Find student by student_id (not database id)
        $student = Student::where('student_id', $validated['student_id'])->first();
        if (!$student) {
            return back()->withErrors(['student_id' => 'Student not found']);
        }

        // Create result
        Result::create([
            'student_id' => $student->id, // Use database id
            'subject' => $validated['course'], // Store course as subject in database
            'exam_type' => 'General', // Default exam type since it's not in form
            'score' => $validated['score'],
            'grade' => $validated['grade'],
            'status' => 'published',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.results')
            ->with('success', 'Result published successfully!');
    }

    public function deleteResult($id)
    {
        try {
            $result = Result::find($id);
            if (!$result) {
                return response()->json(['success' => false, 'message' => 'Result not found'], 404);
            }

            $result->delete();

            return response()->json(['success' => true, 'message' => 'Result deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Delete result error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting result: ' . $e->getMessage()]);
        }
    }
}
