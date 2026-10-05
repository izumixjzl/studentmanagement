<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::leftJoin(
                'courses',
                'students.course_id',
                '=',
                'courses.id'
            )
            ->select(
                'students.*',
                'courses.course_code',
                'courses.course_name'
            )
            ->latest('students.created_at')
            ->take(8)
            ->get();

        $studentCount = Student::count();

        $courseCount = Course::count();

        $newStudentCount = Student::where('created_at', '>=', now()->subDays(30))->count();

        $unassignedCount = Student::whereNull('course_id')->count();

        $topCourses = Course::withCount('students')
            ->orderByDesc('students_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'students',
            'studentCount',
            'courseCount',
            'newStudentCount',
            'unassignedCount',
            'topCourses'
        ));
    }
}
