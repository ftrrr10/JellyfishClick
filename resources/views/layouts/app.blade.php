<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen text-gray-900">
    <div class="relative min-h-screen flex">
        <aside class="text-lg font-bold font[poppins] absolute top-6 left-6 w-64 bg-purple-100 text-blue-900 shadow-2xl rounded-2xl p-6 z-20">
            <div class="mb-6 text-center">
                <img src="{{ asset('images/jellybook.png') }}" alt="Logo" class="h-26 mx-auto mb-2">
                <h2 class="text-xl font-bold tracking-wide text-purple-900">JELLYBOOK.IO</h2>
                <div class="border-b-2 border-blue-900 mt-4 w-full"></div>
            </div>
            
            <nav class="flex flex-col space-y-4 text-left">
                {{-- =================================== --}}
                {{--      MENU UNTUK SEMUA USER         --}}
                {{-- =================================== --}}
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">DASHBOARD</a>
                <a href="{{ route('books.index') }}" class="sidebar-link {{ request()->is('books*') ? 'active' : '' }}">BOOKS</a>
                <a href="{{ route('loans.create') }}" class="sidebar-link {{ request()->is('loans/create') ? 'active' : '' }}">FORM PEMINJAM</a>
                <a href="{{ route('loans.index') }}" class="sidebar-link {{ request()->is('loans') ? 'active' : '' }}">HISTORY PEMINJAM</a>
                <a href="{{ route('ratings.index') }}" class="sidebar-link {{ request()->is('ratings*') ? 'active' : '' }}">RATINGS</a>
                <a href="{{ route('recommendations.index') }}" class="sidebar-link {{ request()->is('recommendations*') ? 'active' : '' }}">RECOMMENDATIONS</a>
                
                {{-- =================================== --}}
                {{--      MENU KHUSUS UNTUK ADMIN       --}}
                {{-- =================================== --}}
                @if (auth()->user() && auth()->user()->isAdmin())
                    <div class="border-b border-purple-300 w-full my-2"></div>
                    <p class="text-xs text-purple-800 -mb-2 font-semibold tracking-wider">ADMINISTRATION</p>
                    
                    <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}">CATEGORIES</a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">USERS</a>
                @endif
                
                {{-- Tombol Logout --}}
                <div class="pt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full sidebar-link text-red-400 hover:text-white hover:bg-red-600">Logout</button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-1 ml-72 p-10">
            @yield('content')
        </main>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('scripts')
</body>
</html>