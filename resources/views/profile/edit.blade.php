@extends('layouts.app')
@section('title', 'Profil')

@section('content')
<h1 class="page-title-center">Profil Saya</h1>

<div class="form-card form-gap">
    <h2>Data Akun</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf @method('PUT')
        <label for="name">Nama</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>

        <div class="form-actions"><button class="btn" type="submit">Simpan Profil</button></div>
    </form>
</div>

<div class="form-card">
    <h2>Ganti Password</h2>
    <form method="POST" action="{{ route('profile.password') }}">
        @csrf @method('PUT')
        <label for="current_password">Password saat ini</label>
        <input id="current_password" type="password" name="current_password" required>

        <label for="password">Password baru</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Ulangi password baru</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <div class="form-actions"><button class="btn btn-green" type="submit">Ganti Password</button></div>
    </form>
</div>
@endsection
