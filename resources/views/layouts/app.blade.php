<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'OliNabilAza Planner') · OliNabilAza Planner</title>
    {{-- Font isi: Poppins. Font header: ChemyRetro (dimuat dari public/fonts lewat style.css) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="@yield('bodyclass')">
<div class="page">

    <header class="nav">
        <a class="logo" href="{{ route('dashboard') }}">OliNabilAza Planner</a>

        @auth
            <nav class="nav-links">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('courses.index') }}" class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">Courses</a>
                <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">Tasks</a>
                <a href="{{ route('notes.index') }}" class="{{ request()->routeIs('notes.*') ? 'active' : '' }}">Notes</a>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">Profile</a>
                <form class="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit" title="Log out" aria-label="Log out">
                        <svg viewBox="0 0 30 26" fill="none" stroke="currentColor" aria-hidden="true">
                            <path d="M19 3.4H14.5a9.6 9.6 0 0 0 0 19.2H19" stroke-width="4.6"/>
                            <path d="M11 13H27M21.5 7L27.5 13L21.5 19" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </nav>
        @else
            <nav class="nav-links guest">
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
            </nav>
        @endauth
    </header>

    @if (session('success'))
        <div class="alert alert-ok">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-err">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="footer">OliNabilAza Planner ☆ KEEP GOING</footer>
</div>
</body>
</html>
