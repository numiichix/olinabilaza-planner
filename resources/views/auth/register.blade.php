@extends('layouts.app')
@section('title', 'Daftar')
@section('bodyclass', 'grad')

@section('content')
<div class="hero">
    <h1>Buat Akun Baru</h1>
    <p>Mulai atur mata kuliah, tugas, dan catatanmu.</p>
</div>

<div class="form-card login-card">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Nama lengkap</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password (min. 6 karakter)</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Ulangi password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <div class="form-actions">
            <button class="btn" type="submit">Daftar</button>
            <a class="btn btn-outline" href="{{ route('login') }}">Sudah punya akun</a>
        </div>
    </form>
</div>
@endsection
