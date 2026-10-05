<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display all students.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $days = (int) $request->query('days');
        $perPage = in_array((int) $request->query('per_page'), [10, 25, 50])
            ? (int) $request->query('per_page')
            : 10;

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
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('students.first_name', 'like', "%{$search}%")
                        ->orWhere('students.last_name', 'like', "%{$search}%")
                        ->orWhere('students.student_id', 'like', "%{$search}%")
                        ->orWhereRaw("CONCAT(students.first_name, ' ', students.last_name) like ?", ["%{$search}%"]);
                });
            })
            ->when(in_array($days, [7, 30, 90]), function ($query) use ($days) {
                $query->where('students.created_at', '>=', now()->subDays($days));
            })
            ->latest('students.created_at')
            ->paginate($perPage)
            ->withQueryString();

        return view('students.index', compact('students', 'search', 'days', 'perPage'));
    }


    /**
     * Delete several students at once.
     */
    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        $count = Student::whereIn('id', $validated['ids'])->delete();

        return redirect()
            ->route('students.index')
            ->with('success', "{$count} student(s) deleted successfully.");
    }


    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        $courses = Course::orderBy('course_name')->get();

        return view('students.create', compact('courses'));
    }


    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:50|unique:students,student_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|email|max:255|unique:students,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required|string|max:50',
        ]);

        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully.');
    }


    /**
     * Display a specific student.
     */
    public function show(Student $student)
    {
        $student->load('course');

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(Student $student)
    {
        $courses = Course::orderBy('course_name')->get();

        return view(
            'students.edit',
            compact('student', 'courses')
        );
    }


    /**
     * Update a student.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_id' => 'required|string|max:50|unique:students,student_id,' . $student->id,
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'year_level' => 'required|string|max:50',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }


    /**
     * Delete a student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}