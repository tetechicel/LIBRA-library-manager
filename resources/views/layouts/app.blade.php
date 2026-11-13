<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LIBRA — Library Management' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/libra.css') }}">
    @livewireStyles
</head>

<body>
    <div class="app-shell">
        <aside class="world-nav">
            <div class="brand">
                <div class="brand-mark"><span></span><span></span><span></span></div>
                <div><strong>LIBRA</strong><small>Library keeper</small></div>
            </div>

            <div class="nav-rope"></div>

            <nav aria-label="Main navigation">
                <a href="{{ route('dashboard') }}" @class(['active' => request()->routeIs('dashboard')]) aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}"><span class="nav-icon">⌂</span><span>Dashboard</span></a>
                <a href="{{ route('books') }}" @class(['active' => request()->routeIs('books')]) aria-current="{{ request()->routeIs('books') ? 'page' : 'false' }}"><span class="nav-icon">▤</span><span>Books</span></a>
                <a href="{{ route('profile') }}" @class(['active' => request()->routeIs('profile')]) aria-current="{{ request()->routeIs('profile') ? 'page' : 'false' }}"><span class="nav-icon">♙</span><span>Profile</span></a>
                <a href="{{ route('members') }}" @class(['active' => request()->routeIs('members')]) aria-current="{{ request()->routeIs('members') ? 'page' : 'false' }}"><span class="nav-icon">♟</span><span>Members</span></a>
                <a href="{{ route('borrowing') }}" @class(['active' => request()->routeIs('borrowing')]) aria-current="{{ request()->routeIs('borrowing') ? 'page' : 'false' }}"><span class="nav-icon">→</span><span>Borrowing</span></a>
                <a href="{{ route('returns') }}" @class(['active' => request()->routeIs('returns')]) aria-current="{{ request()->routeIs('returns') ? 'page' : 'false' }}"><span class="nav-icon">↩</span><span>Returns</span></a>
                <a href="{{ route('reports') }}" @class(['active' => request()->routeIs('reports')]) aria-current="{{ request()->routeIs('reports') ? 'page' : 'false' }}"><span class="nav-icon">▥</span><span>Reports</span></a>
                <a href="{{ route('settings') }}" @class(['active' => request()->routeIs('settings')]) aria-current="{{ request()->routeIs('settings') ? 'page' : 'false' }}"><span class="nav-icon">◇</span><span>Settings</span></a>
            </nav>

            <div class="nav-account">
                <a class="nav-profile" href="/profile">
                    <span class="nav-avatar"><span class="export-avatar"></span></span>
                    <span><small>Signed in as</small><strong data-bind="profile.name">Clara Wijaya</strong></span>
                </a>
                <button class="logout-button" data-livewire-click="logout">
                    <span>↪</span><span>Logout</span>
                </button>
                <div class="nav-hours">
                    <div class="mini-lamp"><i></i></div>
                    <div><small>Library hours</small><strong>08:00 — 18:00</strong></div>
                </div>
            </div>
        </aside>

        <main class="main-world">
            <header class="page-header">
                <div>
                    @yield('page-title', 'Dashboard')
                </div>
                <div class="date-plaque">
                    <span>{{ strtoupper(now()->format('D')) }}</span>
                    <strong>{{ now()->format('d') }}</strong>
                    <small>{{ strtoupper(now()->format('M')) }}</small>
                </div>
            </header>

            <div class="page-content">
                @yield('content')
                {{ $slot ?? '' }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
