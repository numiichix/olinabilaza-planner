@extends('layouts.app')
@section('title', 'Add Course')

@section('content')
<h1 class="page-title-center">Add Course</h1>
<div class="form-card">
    <form method="POST" action="{{ route('courses.store') }}">
        @include('courses._form')
    </form>
</div>
@endsection
