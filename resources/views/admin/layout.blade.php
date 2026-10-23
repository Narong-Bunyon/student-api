<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Book Admin - Library Management' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Chart.js (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="h-full bg-[#f4f7fb] text-slate-800 antialiased overflow-x-hidden">
    <div class="min-h-screen flex">
        <!-- Persistent Admin Sidebar Navigation -->
        <aside class="w-64 bg-[#231e54] text-white flex-shrink-0 flex flex-col justify-between py-6 px-4 select-none sticky top-0 h-screen overflow-y-auto">
            <div>
                <!-- Brand / Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 mb-8 group block">
                    @if(!empty($globalSystemLogo))
                        <div class="w-11 h-11 rounded-full bg-white/10 p-0.5 border border-indigo-400/40 shadow-md group-hover:scale-105 transition shrink-0 overflow-hidden flex items-center justify-center">
                            <img src="{{ Str::startsWith($globalSystemLogo, 'http') ? $globalSystemLogo : asset('storage/' . $globalSystemLogo) }}" 
                                 alt="{{ $globalSystemName ?? 'Book Admin' }}" 
                                 class="w-full h-full rounded-full object-cover" />
                        </div>
                    @else
                        <div class="w-11 h-11 rounded-full bg-indigo-500/30 flex items-center justify-center text-white border border-indigo-400/30 shadow-inner group-hover:bg-indigo-500/40 transition shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                    <div class="min-w-0">
                        <h1 class="text-base font-bold tracking-tight text-white leading-tight truncate">
                            {{ $globalSystemName ?? 'Book Admin' }}
                        </h1>
                        <p class="text-[11px] text-indigo-300 font-medium truncate">
                            {{ $globalSystemTagline ?? 'Library Management' }}
                        </p>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="space-y-1.5 text-sm font-medium">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('dashboard') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Books -->
                    <a href="{{ route('books.index') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('books.*') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('books.*') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Books</span>
                    </a>

                    <!-- Categories -->
                    <a href="{{ route('categories.index') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('categories.*') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span>Categories</span>
                    </a>

                    <!-- Members / Users -->
                    <a href="{{ route('users.index') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('users.*') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('users.*') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Members</span>
                    </a>

                    <!-- Borrowings -->
                    <a href="{{ route('borrowings.index') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('borrowings.*') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('borrowings.*') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <span>Borrowings</span>
                    </a>

                    <!-- Reports (Summary view) -->
                    <a href="{{ route('admin.reports') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('admin.reports') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.reports') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Reports</span>
                    </a>

                    <!-- Settings (Admin Settings) -->
                    <a href="{{ route('admin.settings') }}" 
                       class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition font-medium {{ request()->routeIs('admin.settings') ? 'bg-[#4b3ecb] text-white font-semibold shadow-lg shadow-indigo-900/30' : 'text-indigo-200 hover:text-white hover:bg-white/10' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.settings') ? 'text-white' : 'text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Slogan & Back to Site -->
            <div class="px-2 pt-6 border-t border-indigo-900/40">
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-2 rounded-xl text-xs font-semibold text-indigo-300 hover:text-white hover:bg-white/5 transition mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span>View Client Site</span>
                </a>
                <div class="flex items-center gap-2.5 text-indigo-300/80 px-2">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <div class="text-[11px] leading-tight font-medium">
                        <div>Better Books</div>
                        <div class="text-indigo-400">Brighter Minds</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Body Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Bar Header with Search & Admin Profile -->
            <header class="bg-white border-b border-slate-100 h-20 px-8 flex items-center justify-between sticky top-0 z-20">
                <!-- Search Input matching mockup -->
                <div class="w-full max-w-md">
                    <form action="{{ route('books.index') }}" method="GET" class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books, authors, or members..." class="w-full pl-10 pr-4 py-2 text-xs sm:text-sm bg-[#f4f7fb] border border-transparent rounded-full focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-700 placeholder-slate-400 outline-none transition" />
                    </form>
                </div>

                <!-- Right Side Actions & Profile -->
                <div class="flex items-center gap-5 ml-4">
                    <!-- Notification Bell -->
                    <button class="relative p-2 text-slate-400 hover:text-slate-600 transition rounded-full hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    </button>

                    <!-- Admin Profile Interactive Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <button @click="open = !open" 
                                type="button" 
                                class="flex items-center gap-2.5 p-1 rounded-2xl hover:bg-slate-100/80 transition focus:outline-none">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-200 shadow-sm" />
                            @else
                                <div class="w-9 h-9 rounded-full bg-[#5b51d8] text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                                    {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                                </div>
                            @endif
                            <div class="text-left hidden sm:block">
                                <div class="text-sm font-bold text-slate-800 flex items-center gap-1">
                                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                                <div class="text-[10px] text-slate-400 capitalize font-medium">{{ Auth::user()->role ?? 'Administrator' }}</div>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute right-0 mt-2.5 w-64 bg-white rounded-2xl shadow-2xl border border-slate-100 py-2 z-50 overflow-hidden"
                             style="display: none;">
                            
                            <!-- Profile Header Header Card -->
                            <div class="px-4 py-3 bg-gradient-to-r from-slate-50 to-indigo-50/40 border-b border-slate-100 flex items-center gap-3">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm" />
                                @else
                                    <div class="w-10 h-10 rounded-full bg-[#5b51d8] text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
                                        {{ substr(Auth::user()->name ?? 'AD', 0, 2) }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <div class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] text-slate-400 truncate">{{ Auth::user()->email }}</div>
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-indigo-100 text-indigo-700 capitalize">
                                        {{ Auth::user()->role ?? 'Administrator' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Menu Links -->
                            <div class="py-1 text-xs font-medium text-slate-700">
                                <!-- Profile Settings -->
                                <a href="{{ route('admin.profile') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 hover:text-indigo-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>My Profile</span>
                                </a>

                                <!-- System Settings -->
                                <a href="{{ route('admin.settings') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 hover:text-indigo-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>System Settings &amp; Logo</span>
                                </a>

                                <!-- Reports & Analytics -->
                                <a href="{{ route('admin.reports') }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 hover:text-indigo-600 transition group">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    <span>Analytics &amp; Reports</span>
                                </a>

                                <!-- Public Site -->
                                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-slate-50 hover:text-indigo-600 transition group border-t border-slate-100">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span>Visit Client Website</span>
                                </a>
                            </div>

                            <!-- Logout Action -->
                            <div class="pt-1 border-t border-slate-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition group">
                                        <svg class="w-4 h-4 text-rose-500 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        <span>Sign Out of Admin</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Dynamic Admin Content Area -->
            <main class="flex-1 p-8 overflow-y-auto">
                <!-- Flash messages -->
                @if(session('success'))
                    <div id="flash-success-alert" class="mb-6 px-4 py-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center justify-between shadow-sm transition-all duration-500">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="dismissAlert('flash-success-alert')" class="text-emerald-500 hover:text-emerald-700 p-1 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div id="flash-error-alert" class="mb-6 px-4 py-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold flex items-center justify-between shadow-sm transition-all duration-500">
                        <div class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" onclick="dismissAlert('flash-error-alert')" class="text-rose-500 hover:text-rose-700 p-1 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        function dismissAlert(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-8px)';
                setTimeout(() => el.remove(), 400);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            ['flash-success-alert', 'flash-error-alert'].forEach(function(id) {
                const alertEl = document.getElementById(id);
                if (alertEl) {
                    setTimeout(() => {
                        dismissAlert(id);
                    }, 2500); // Automatically fades out and disappears after 2.5 seconds
                }
            });
        });
    </script>
</body>
</html>
