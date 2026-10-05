@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')

<h1 class="mb-4">Edit Student</h1>

<form
    action="{{ route('students.update', $student) }}"
    method="POST"
>

@csrf
@method('PUT')

<div class="card shadow-sm">

<div class="card-body">

@include('students._form')

<button class="btn btn-primary">
    Update Student
</button>

<a
    href="{{ route('students.index') }}"
    class="btn btn-secondary"
>
    Cancel
</a>

</div>

</div>

</form>

@endsection