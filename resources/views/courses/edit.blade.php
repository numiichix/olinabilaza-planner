@extends('layouts.app')
@section('title', 'Edit Course')

@section('content')
<h1 class="page-title-center">Edit Course</h1>
<div class="form-card">
    <form method="POST" action="{{ route('courses.update', $course) }}">
        @method('PUT')
        @include('courses._form')
    </form>
</div>
@endsection
