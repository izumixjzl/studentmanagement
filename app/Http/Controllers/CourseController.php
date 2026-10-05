<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search'));
        $days = (int) $request->query('days');
        $perPage = in_array((int) $request->query('per_page'), [10, 25, 50])
            ? (int) $request->query('per_page')
            : 10;

        $courses = Course::withCount('students')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('course_code', 'like', "%{$search}%")
                        ->orWhere('course_name', 'like', "%{$search}%");
                });
            })
            ->when(in_array($days, [7, 30, 90]), function ($query) use ($days) {
                $query->where('created_at', '>=', now()->subDays($days));
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('courses.index', compact('courses', 'search', 'days', 'perPage'));
    }


    /**
     * Delete several courses at once.
     */
    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        $count = Course::whereIn('id', $validated['ids'])->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', "{$count} course(s) deleted successfully.");
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('students');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|string|max:50|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}