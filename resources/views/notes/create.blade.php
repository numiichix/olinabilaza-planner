@extends('layouts.app')
@section('title', 'Add Note')

@section('content')
<h1 class="page-title-center">Add Note</h1>
<div class="form-card">
    <form method="POST" action="{{ route('notes.store') }}">
        @include('notes._form')
    </form>
</div>
@endsection
