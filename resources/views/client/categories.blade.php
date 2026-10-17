@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800">
    <!-- Hero Banner with Gradient & Search -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-16 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-200 border border-indigo-400/30 backdrop-blur-md mb-5">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Curated Academic Disciplines
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                Explore Library <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-sky-300 to-teal-200">Categories</span>
            </h1>

            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Discover our extensive collection organized by subject. Select any academic field or discipline to browse all related books and literature.
            </p>

            <!-- Quick Metrics -->
            <div class="mt-8 flex items-center justify-center gap-8 border-t border-indigo-800/50 pt-6 max-w-md mx-auto text-center">
                <div>
                    <div class="text-2xl sm:text-3xl font-black text-white">{{ $totalCategories ?? $categories->count() }}</div>
                    <div class="text-[11px] uppercase tracking-wider text-indigo-200 font-semibold mt-0.5">Total Disciplines</div>
                </div>
                <div class="h-8 w-px bg-indigo-800/70"></div>
                <div>
                    <div class="text-2xl sm:text-3xl font-black text-white">{{ $totalBooks ?? 0 }}</div>
                    <div class="text-[11px] uppercase tracking-wider text-indigo-200 font-semibold mt-0.5">Cataloged Books</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search / Filter Bar -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <form method="GET" action="{{ route('client.categories') }}" class="bg-white rounded-2xl shadow-xl border border-slate-200/90 p-4 sm:p-5 flex flex-col sm:flex-row gap-3 items-center">
            <div class="relative w-full flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search category by name or keywords..." 
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm"
                >
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition flex items-center justify-center gap-1.5">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('client.categories') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Category Catalog Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-200 gap-3">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 flex items-center gap-2">
                    Available Subject Departments
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">
                    Showing {{ $categories->count() }} active academic {{ Str::plural('category', $categories->count()) }}
                </p>
            </div>

            @if(request('search'))
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-100 self-start sm:self-auto">
                    Search result for "{{ request('search') }}"
                </span>
            @endif
        </div>

        @if($categories->count() > 0)
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $gradients = [
                        ['from' => 'from-blue-600', 'to' => 'to-indigo-600', 'bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'hover:border-indigo-400'],
                        ['from' => 'from-emerald-500', 'to' => 'to-teal-600', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'hover:border-emerald-400'],
                        ['from' => 'from-purple-500', 'to' => 'to-indigo-600', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600', 'border' => 'hover:border-purple-400'],
                        ['from' => 'from-amber-500', 'to' => 'to-orange-600', 'bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'hover:border-amber-400'],
                        ['from' => 'from-sky-500', 'to' => 'to-blue-600', 'bg' => 'bg-sky-50', 'text' => 'text-sky-600', 'border' => 'hover:border-sky-400'],
                        ['from' => 'from-rose-500', 'to' => 'to-pink-600', 'bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'hover:border-rose-400'],
                    ];
                @endphp

                @foreach($categories as $index => $category)
                    @php
                        $color = $gradients[$index % count($gradients)];
                    @endphp
                    <div class="group bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl {{ $color['border'] }} transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        <div class="p-6">
                            <!-- Top badge and icon -->
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr {{ $color['from'] }} {{ $color['to'] }} text-white flex items-center justify-center font-black text-lg shadow-md group-hover:scale-105 transition-transform duration-300">
                                    {{ strtoupper(substr($category->name, 0, 2)) }}
                                </div>
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full {{ $color['bg'] }} {{ $color['text'] }} border border-slate-200/60">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    {{ $category->books_count ?? 0 }} {{ Str::plural('Book', $category->books_count ?? 0) }}
                                </span>
                            </div>

                            <!-- Name -->
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                {{ $category->name }}
                            </h3>

                            <!-- Description -->
                            <p class="text-sm text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                {{ $category->description ?? 'Explore specialized academic materials, textbooks, course readings, and research publications curated for this discipline.' }}
                            </p>
                        </div>

                        <!-- Card Action Footer -->
                        <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-mono text-slate-400">Department #{{ $category->id }}</span>
                            <a href="{{ route('home', ['category' => $category->id]) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-indigo-600 group-hover:text-indigo-700 transition">
                                Browse Books
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty state -->
            <div class="mt-12 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 max-w-md mx-auto p-8">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <h3 class="text-base font-bold text-slate-800">No categories found</h3>
                <p class="text-sm text-slate-500 mt-1">We couldn't find any categories matching your query.</p>
                <div class="mt-5">
                    <a href="{{ route('client.categories') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                        View All Categories
                    </a>
                </div>
            </div>
        @endif

        <!-- Quick Info Banner -->
        <div class="mt-16 bg-white rounded-2xl border border-slate-200/90 p-8 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="max-w-xl">
                <h3 class="text-lg font-bold text-slate-900">Looking for a specific book?</h3>
                <p class="text-sm text-slate-500 mt-1">
                    You can also search directly by title, author, or ISBN across our entire catalog from the library home page.
                </p>
            </div>
            <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md shadow-indigo-600/20 transition whitespace-nowrap">
                Go to Main Catalog &rarr;
            </a>
        </div>
    </div>
</div>
@endsection
