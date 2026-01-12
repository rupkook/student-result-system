<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Course;
use App\Models\Result;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create students
        $students = [
            [
                'student_id' => 'STU001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1234567890',
                'date_of_birth' => '2000-01-15',
                'gender' => 'male',
                'address' => '123 Main St, City, State',
                'department' => 'mernstack',
                'status' => 'active',
                'password' => Hash::make('password123'),
            ],
            [
                'student_id' => 'STU002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+0987654321',
                'date_of_birth' => '2001-05-20',
                'gender' => 'female',
                'address' => '456 Oak Ave, Town, State',
                'department' => 'UIUX',
                'status' => 'active',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }

        // Create 10 static courses
        $courses = [
            [
                'course_code' => 'MERN001',
                'course_name' => 'MERN Stack Development',
                'description' => 'Complete MERN stack development with MongoDB, Express, React, and Node.js',
                'credits' => 4,
                'department' => 'mernstack',
                'instructor' => 'John Smith',
                'max_students' => 30,
                'status' => 'active',
            ],
            [
                'course_code' => 'WEB001',
                'course_name' => 'Web App Development (Full-Stack)',
                'description' => 'Full-stack web development using modern frameworks and technologies',
                'credits' => 4,
                'department' => 'Web app development (full-stack)',
                'instructor' => 'Sarah Johnson',
                'max_students' => 25,
                'status' => 'active',
            ],
            [
                'course_code' => 'UIUX001',
                'course_name' => 'UI/UX Design',
                'description' => 'User interface and user experience design principles and practices',
                'credits' => 3,
                'department' => 'UIUX',
                'instructor' => 'Emily Davis',
                'max_students' => 20,
                'status' => 'active',
            ],
            [
                'course_code' => 'PYT001',
                'course_name' => 'Python Programming',
                'description' => 'Python programming from basics to advanced concepts',
                'credits' => 4,
                'department' => 'Python Programing',
                'instructor' => 'Michael Brown',
                'max_students' => 35,
                'status' => 'active',
            ],
            [
                'course_code' => 'GRD001',
                'course_name' => 'Graphic Design',
                'description' => 'Graphic design fundamentals and digital art creation',
                'credits' => 3,
                'department' => 'Graphic Design',
                'instructor' => 'Lisa Wilson',
                'max_students' => 25,
                'status' => 'active',
            ],
            [
                'course_code' => 'MOT001',
                'course_name' => 'Motion Design',
                'description' => 'Motion graphics and animation design',
                'credits' => 3,
                'department' => 'Motion Design',
                'instructor' => 'David Martinez',
                'max_students' => 15,
                'status' => 'active',
            ],
            [
                'course_code' => 'VID001',
                'course_name' => 'Video Editing',
                'description' => 'Professional video editing and post-production',
                'credits' => 3,
                'department' => 'Vedio Editing',
                'instructor' => 'Jennifer Taylor',
                'max_students' => 20,
                'status' => 'active',
            ],
            [
                'course_code' => 'DMK001',
                'course_name' => 'Digital Marketing',
                'description' => 'Digital marketing strategies and online advertising',
                'credits' => 3,
                'department' => 'Digital Marketing',
                'instructor' => 'Robert Anderson',
                'max_students' => 30,
                'status' => 'active',
            ],
            [
                'course_code' => 'SEC001',
                'course_name' => 'Cybersecurity',
                'description' => 'Cybersecurity fundamentals and ethical hacking',
                'credits' => 4,
                'department' => 'Cybersecurity',
                'instructor' => 'William Thompson',
                'max_students' => 25,
                'status' => 'active',
            ],
            [
                'course_code' => 'SCI001',
                'course_name' => 'Data Science',
                'description' => 'Data analysis, machine learning, and data visualization',
                'credits' => 4,
                'department' => 'Data Science',
                'instructor' => 'Amanda White',
                'max_students' => 20,
                'status' => 'active',
            ],
            [
                'course_code' => 'NET001',
                'course_name' => 'Networking',
                'description' => 'Computer networks and network security',
                'credits' => 3,
                'department' => 'Networking',
                'instructor' => 'Christopher Lee',
                'max_students' => 25,
                'status' => 'active',
            ],
        ]; 

        foreach ($courses as $course) {
            Course::create($course);
        }

        // Create enrollments
        $student1 = Student::where('student_id', 'STU001')->first();
        $student2 = Student::where('student_id', 'STU002')->first();
        
        $course1 = Course::where('course_code', 'MERN001')->first();
        $course2 = Course::where('course_code', 'WEB001')->first();
        $course3 = Course::where('course_code', 'UIUX001')->first();

        // Enroll students in courses
        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
            'enrollment_date' => now(),
            'status' => 'active',
            'progress_percentage' => 75.50,
        ]);

        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
            'enrollment_date' => now(),
            'status' => 'active',
            'progress_percentage' => 60.25,
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course1->id,
            'enrollment_date' => now(),
            'status' => 'active',
            'progress_percentage' => 85.75,
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course3->id,
            'enrollment_date' => now(),
            'status' => 'active',
            'progress_percentage' => 92.00,
        ]);

        // Create sample results
        Result::create([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
            'exam_type' => 'Midterm Exam',
            'marks' => 85.50,
            'total_marks' => 100.00,
            'grade' => 'B+',
            'gpa' => 3.50,
            'status' => 'published',
            'exam_date' => '2024-10-15',
            'remarks' => 'Good performance, needs improvement in practical applications',
        ]);

        Result::create([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
            'exam_type' => 'Final Exam',
            'marks' => 78.00,
            'total_marks' => 100.00,
            'grade' => 'B',
            'gpa' => 3.20,
            'status' => 'published',
            'exam_date' => '2024-12-10',
            'remarks' => 'Solid understanding of core concepts',
        ]);

        Result::create([
            'student_id' => $student2->id,
            'course_id' => $course1->id,
            'exam_type' => 'Midterm Exam',
            'marks' => 92.00,
            'total_marks' => 100.00,
            'grade' => 'A-',
            'gpa' => 3.70,
            'status' => 'published',
            'exam_date' => '2024-10-15',
            'remarks' => 'Excellent work, very thorough',
        ]);

        Result::create([
            'student_id' => $student2->id,
            'course_id' => $course3->id,
            'exam_type' => 'Quiz 1',
            'marks' => 88.50,
            'total_marks' => 100.00,
            'grade' => 'B+',
            'gpa' => 3.50,
            'status' => 'published',
            'exam_date' => '2024-09-20',
            'remarks' => 'Strong analytical skills demonstrated',
        ]);
    }
}
