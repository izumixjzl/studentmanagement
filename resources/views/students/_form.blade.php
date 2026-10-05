<div class="row">

    <div class="col-md-4 mb-3">
        <label class="form-label">Student ID</label>

        <input
            type="text"
            name="student_id"
            class="form-control"
            value="{{ old('student_id', $student->student_id ?? '') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">First Name</label>

        <input
            type="text"
            name="first_name"
            class="form-control"
            value="{{ old('first_name', $student->first_name ?? '') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Middle Name</label>

        <input
            type="text"
            name="middle_name"
            class="form-control"
            value="{{ old('middle_name', $student->middle_name ?? '') }}"
        >
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Last Name</label>

        <input
            type="text"
            name="last_name"
            class="form-control"
            value="{{ old('last_name', $student->last_name ?? '') }}"
            required
        >
    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">Gender</label>

        <select name="gender" class="form-select" required>

            <option value="">Select Gender</option>

            @foreach(['Male', 'Female', 'Other'] as $gender)

                <option
                    value="{{ $gender }}"
                    {{ old('gender', $student->gender ?? '') == $gender ? 'selected' : '' }}
                >
                    {{ $gender }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label class="form-label">
            Date of Birth
        </label>

        <input
            type="date"
            name="date_of_birth"
            class="form-control"
            value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}"
        >

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Email
        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="{{ old('email', $student->email ?? '') }}"
            required
        >

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Phone
        </label>

        <input
            type="text"
            name="phone"
            class="form-control"
            value="{{ old('phone', $student->phone ?? '') }}"
        >

    </div>

    <div class="col-md-12 mb-3">

        <label class="form-label">
            Address
        </label>

        <textarea
            name="address"
            class="form-control"
            rows="3"
        >{{ old('address', $student->address ?? '') }}</textarea>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Course
        </label>

        <select
            name="course_id"
            class="form-select"
        >

            <option value="">
                Select Course
            </option>

            @foreach($courses as $course)

                <option
                    value="{{ $course->id }}"
                    {{ old('course_id', $student->course_id ?? '') == $course->id ? 'selected' : '' }}
                >
                    {{ $course->course_code }}
                    -
                    {{ $course->course_name }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Year Level
        </label>

        <select
            name="year_level"
            class="form-select"
            required
        >

            @foreach([
                '1st Year',
                '2nd Year',
                '3rd Year',
                '4th Year'
            ] as $year)

                <option
                    value="{{ $year }}"
                    {{ old('year_level', $student->year_level ?? '') == $year ? 'selected' : '' }}
                >
                    {{ $year }}
                </option>

            @endforeach

        </select>

    </div>

</div>