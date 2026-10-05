@extends('layouts.app')

@section('title', 'Dashboard')

@push('styles')
@include('partials.list-styles')
<style>
    .stat-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(30, 30, 60, 0.05);
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        height: 100%;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--sl-muted);
        margin-bottom: 2px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--sl-text);
        line-height: 1.2;
    }

    .sl-link {
        font-size: 0.82rem;
        color: var(--sl-purple);
        text-decoration: none;
    }

    .sl-link:hover {
        color: var(--sl-purple-dark);
        text-decoration: underline;
    }

    .course-bar {
        height: 6px;
        border-radius: 3px;
        background: var(--sl-purple-soft);
        overflow: hidden;
    }

    .course-bar span {
        display: block;
        height: 100%;
        background: var(--sl-purple);
        border-radius: 3px;
    }
</style>
@endpush

@section('content')

@php
    $avatarColors = ['#f59f00', '#7a1fd6', '#1c7ed6', '#e8590c', '#2f9e44', '#d6336c', '#0ca678', '#5c7cfa'];
    $maxCourseStudents = max(1, $topCourses->max('students_count') ?? 0);

    $stats = [
        ['label' => 'Total Students', 'value' => $studentCount, 'icon' => 'bi-people-fill', 'color' => '#7a1fd6', 'bg' => '#f4ecfd'],
        ['label' => 'Total Courses', 'value' => $courseCount, 'icon' => 'bi-journal-bookmark-fill', 'color' => '#1c7ed6', 'bg' => '#e7f1fd'],
        ['label' => 'New (Last 30 Days)', 'value' => $newStudentCount, 'icon' => 'bi-person-plus-fill', 'color' => '#2f9e44', 'bg' => '#e9f7ec'],
        ['label' => 'No Course Assigned', 'value' => $unassignedCount, 'icon' => 'bi-exclamation-circle-fill', 'color' => '#e8590c', 'bg' => '#fdf0e7'],
    ];
@endphp


<!-- HEADER -->

<div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-4">

    <div>
        <h1 class="sl-title">Dashboard</h1>

        <div class="sl-breadcrumb">
            <span class="current">Home</span>
            &nbsp;/&nbsp;
            Overview
        </div>
    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('courses.create') }}"
            class="btn btn-outline-secondary"
            style="border-radius: 6px; font-size: 0.9rem; padding: 9px 18px;"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Course
        </a>

        <a
            href="{{ route('students.create') }}"
            class="btn btn-sl"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Students
        </a>

    </div>

</div>


<!-- STATISTICS -->

<div class="row g-3 mb-4">

    @foreach($stats as $stat)

        <div class="col-sm-6 col-xl-3">

            <div class="stat-card">

                <div
                    class="stat-icon"
                    style="background: {{ $stat['bg'] }}; color: {{ $stat['color'] }};"
                >
                    <i class="bi {{ $stat['icon'] }}"></i>
                </div>

                <div>
                    <div class="stat-label">{{ $stat['label'] }}</div>
                    <div class="stat-value">{{ $stat['value'] }}</div>
                </div>

            </div>

        </div>

    @endforeach

</div>


<div class="row g-3">

    <!-- RECENT STUDENTS -->

    <div class="col-xl-8">

        <div class="sl-card h-100">

            <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                <h2 class="sl-card-title">Recently Added Students</h2>

                <a href="{{ route('students.index') }}" class="sl-link">
                    View all <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($students->count() > 0)

                <div class="table-responsive">

                    <table class="table sl-table">

                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($students as $student)

                                <tr>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <span
                                                class="sl-avatar"
                                                style="background: {{ $avatarColors[$student->id % count($avatarColors)] }};"
                                            >
                                                {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                            </span>

                                            <a
                                                href="{{ route('students.show', $student->id) }}"
                                                class="sl-name"
                                            >
                                                {{ $student->first_name }} {{ $student->last_name }}
                                            </a>

                                        </div>
                                    </td>

                                    <td>#{{ $student->student_id }}</td>

                                    <td>
                                        @if($student->course_code)
                                            <span title="{{ $student->course_name }}">{{ $student->course_code }}</span>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>{{ $student->year_level ?? 'N/A' }}</td>

                                    <td>{{ $student->created_at?->format('m/d/Y') }}</td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <h5 class="text-muted">No Students Yet</h5>

                    <p class="text-muted">
                        There are currently no students registered.
                    </p>

                    <a href="{{ route('students.create') }}" class="btn btn-sl">
                        <i class="bi bi-plus-lg me-1"></i>
                        Add Students
                    </a>

                </div>

            @endif

        </div>

    </div>


    <!-- TOP COURSES -->

    <div class="col-xl-4">

        <div class="sl-card h-100 pb-3">

            <div class="d-flex justify-content-between align-items-center mb-3 px-1">
                <h2 class="sl-card-title">Students per Course</h2>

                <a href="{{ route('courses.index') }}" class="sl-link">
                    View all <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @forelse($topCourses as $course)

                <div class="px-1 mb-3">

                    <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 0.82rem;">

                        <a
                            href="{{ route('courses.show', $course->id) }}"
                            class="sl-name text-truncate me-2"
                            title="{{ $course->course_name }}"
                        >
                            <strong>{{ $course->course_code }}</strong>
                            <span class="text-muted">· {{ $course->course_name }}</span>
                        </a>

                        <span class="text-nowrap">{{ $course->students_count }}</span>

                    </div>

                    <div class="course-bar">
                        <span style="width: {{ round($course->students_count / $maxCourseStudents * 100) }}%;"></span>
                    </div>

                </div>

            @empty

                <p class="text-muted text-center py-4 mb-0" style="font-size: 0.85rem;">
                    No courses yet.
                    <a href="{{ route('courses.create') }}" class="sl-link">Add one</a>
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection
