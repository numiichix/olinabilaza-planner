@extends('layouts.app')
@section('title', 'Login')
@section('bodyclass', 'grad')

@section('content')
<div class="hero">
    <h1>Welcome !</h1>
    <p>what do you want to work on today?</p>
</div>

<div class="form-card login-card">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label class="check-row"><input type="checkbox" name="remember" value="1"> Remember me</label>

        <div class="form-actions">
            <button class="btn" type="submit">Log in</button>
            <a class="btn btn-outline" href="{{ route('register') }}">Create account</a>
        </div>
    </form>
</div>
@endsection
