@extends('layouts.app')
@section('title', 'Register')
@section('bodyclass', 'grad')

@section('content')
<div class="hero">
    <h1>Create a New Account</h1>
    <p>Start organizing your courses, tasks, and notes.</p>
</div>

<div class="form-card login-card">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Full name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password (min. 6 characters)</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <div class="form-actions">
            <button class="btn" type="submit">Register</button>
            <a class="btn btn-outline" href="{{ route('login') }}">Already have an account</a>
        </div>
    </form>
</div>
@endsection
