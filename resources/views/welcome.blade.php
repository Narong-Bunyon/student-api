<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Student App - Book Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-['Inter'] selection:bg-blue-500 selection:text-white">
        <div class="relative min-h-screen flex flex-col justify-center items-center overflow-hidden">
            
            <!-- Animated Background Elements -->
            <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 2s"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 4s"></div>

            <div class="relative z-10 w-full max-w-5xl mx-auto px-6">
                <!-- Navigation / Login Links -->
                <div class="flex justify-end pt-6 mb-16">
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('home') }}" class="px-5 py-2.5 bg-white/10 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-xl hover:bg-white/20 dark:hover:bg-gray-700/50 transition font-semibold">
                                    {{ auth()->user()->role === 'admin' ? 'Dashboard' : 'Catalog Home' }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-white/10 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-xl hover:bg-white/20 dark:hover:bg-gray-700/50 transition font-semibold">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-xl shadow-lg shadow-blue-500/30 transition font-semibold ml-2">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Hero Section -->
                <div class="text-center py-20 bg-white/30 dark:bg-gray-800/30 backdrop-blur-xl border border-white/20 dark:border-gray-700/30 rounded-3xl shadow-2xl">
                    <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-emerald-400">
                            Book Management
                        </span>
                        <br/> System
                    </h1>
                    
                    <p class="mt-4 text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-10">
                        A modern, fast, and elegant way to manage your library. Track books, categories, and student borrowings seamlessly.
                    </p>

                    <div class="flex justify-center gap-6">
                        @auth
                            <a href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('home') }}" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-2xl shadow-xl shadow-blue-500/30 transition transform hover:-translate-y-1 font-bold text-lg">
                                {{ auth()->user()->role === 'admin' ? 'Enter Dashboard →' : 'Browse Catalog →' }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-2xl shadow-xl shadow-blue-500/30 transition transform hover:-translate-y-1 font-bold text-lg">
                                Get Started
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 pb-20">
                    <div class="p-8 bg-white/20 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl hover:bg-white/30 dark:hover:bg-gray-700/50 transition">
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Book Tracking</h3>
                        <p class="text-gray-600 dark:text-gray-400">Keep an organized record of all books, authors, and ISBNs in your library.</p>
                    </div>

                    <div class="p-8 bg-white/20 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl hover:bg-white/30 dark:hover:bg-gray-700/50 transition">
                        <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Borrowings</h3>
                        <p class="text-gray-600 dark:text-gray-400">Manage student borrowings and returns efficiently with detailed date tracking.</p>
                    </div>

                    <div class="p-8 bg-white/20 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl hover:bg-white/30 dark:hover:bg-gray-700/50 transition">
                        <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">User Roles</h3>
                        <p class="text-gray-600 dark:text-gray-400">Robust authentication and role-based access for admins and regular students.</p>
                    </div>
                </div>

            </div>
        </div>

        <style>
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob {
                animation: blob 7s infinite;
            }
        </style>
    </body>
</html>
