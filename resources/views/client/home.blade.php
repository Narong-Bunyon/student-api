@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-16 sm:py-20 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-200 border border-indigo-400/30 backdrop-blur-md mb-5">
                <svg class="w-4 h-4 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Campus Digital Knowledge Hub
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                Explore, Learn &amp; Borrow <br class="hidden sm:inline" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-sky-300 to-teal-200">
                    Knowledge &amp; Books
                </span>
            </h1>

            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                Discover curated textbooks, monographs, and research materials. Search books with cover previews, track real-time loans, and expand your academic horizons.
            </p>

            <!-- Action buttons -->
            <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                @auth
                    @can('admin')
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm bg-gradient-to-r from-indigo-500 to-sky-500 text-white shadow-lg shadow-indigo-500/25 hover:from-indigo-600 hover:to-sky-600 transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('client.my-borrowings') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold text-sm bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all duration-200">
                            View My Borrowings
                        </a>
                    @endcan
                @else
                    <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-white text-slate-900 shadow-md hover:bg-slate-100 transition">
                        Student Log In
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-indigo-600 hover:bg-indigo-500 border border-indigo-400/40 text-white transition">
                        Create Student Account
                    </a>
                @endauth
                <a href="{{ route('client.categories') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/15 backdrop-blur-md transition">
                    Browse Categories
                </a>
            </div>

            <!-- Stats summary -->
            <div class="mt-12 grid grid-cols-3 gap-6 max-w-xl mx-auto border-t border-indigo-800/60 pt-8 text-center">
                <div>
                    <div class="text-2xl sm:text-3xl font-black text-white">{{ $totalBooks ?? 0 }}</div>
                    <div class="text-[11px] uppercase tracking-wider text-indigo-200 font-semibold mt-1">Available Titles</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-black text-white">{{ $totalCategories ?? 0 }}</div>
                    <div class="text-[11px] uppercase tracking-wider text-indigo-200 font-semibold mt-1">Disciplines</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-black text-white">{{ $totalBorrowings ?? 0 }}</div>
                    <div class="text-[11px] uppercase tracking-wider text-indigo-200 font-semibold mt-1">Recorded Loans</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <form method="GET" action="{{ route('home') }}" class="bg-white rounded-2xl shadow-xl border border-slate-200/90 p-4 sm:p-5 flex flex-col md:flex-row gap-4 items-center">
            <!-- Search input -->
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
                    placeholder="Search by book title, author, or ISBN..." 
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm"
                >
            </div>

            <!-- Category selector -->
            <div class="w-full md:w-64">
                <select 
                    name="category" 
                    class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                >
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->books_count ?? 0 }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit & Reset -->
            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold shadow-md shadow-indigo-600/20 transition-all flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Main Content Catalog -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-200 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Featured Books Collection
                </h2>
                <p class="text-sm text-slate-500 mt-0.5">
                    Browse all library books with verified physical editions and cover art
                </p>
            </div>
            
            @if(request('search') || request('category'))
                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-100 self-start sm:self-auto">
                    Filtered Results ({{ $books->total() }} books found)
                </span>
            @endif
        </div>

        <!-- Books Grid with REAL IMAGES -->
        @if($books->count() > 0)
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($books as $book)
                    <div class="group bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-2xl hover:border-indigo-300 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        
                        <!-- Top Image Banner Section -->
                        <div class="relative h-56 w-full overflow-hidden bg-slate-900">
                            @if(!empty($book->image))
                                <img 
                                    src="{{ $book->image }}" 
                                    alt="{{ $book->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 brightness-95 group-hover:brightness-100"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-tr from-indigo-900 to-slate-800 flex items-center justify-center text-white text-4xl">
                                    📖
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

                            <!-- Floating Badges on Image -->
                            <div class="absolute top-3 left-3 right-3 flex items-center justify-between">
                                <span class="px-2.5 py-1 text-xs font-bold bg-white/90 backdrop-blur-md text-slate-800 rounded-lg shadow-sm">
                                    {{ $book->category->name ?? 'General' }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-100/90 backdrop-blur-md px-2.5 py-0.5 rounded-full shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Available
                                </span>
                            </div>

                            <!-- Floating Quick Title & Category on Image bottom -->
                            <div class="absolute bottom-3 left-4 right-4">
                                <span class="text-[11px] font-mono text-indigo-200/90 tracking-wider uppercase">
                                    ISBN: {{ $book->isbn }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">
                                    <a href="{{ route('client.books.show', $book) }}">
                                        {{ $book->title }}
                                    </a>
                                </h3>

                                <!-- Clickable Author -->
                                <p class="text-xs text-slate-600 mt-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span class="text-slate-400">By</span>
                                    <a href="{{ route('client.authors.show', urlencode($book->author)) }}" class="font-semibold text-slate-700 hover:text-indigo-600 transition truncate">
                                        {{ $book->author }}
                                    </a>
                                </p>

                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                                    <span class="text-slate-400">Published:</span>
                                    <span class="font-medium text-slate-700">
                                        {{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('M Y') : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-mono text-slate-400">Shelf #{{ $book->id }}</span>
                            <a href="{{ route('client.books.show', $book) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-indigo-800 group-hover:translate-x-0.5 transition-all">
                                View Details &amp; Borrow &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $books->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="mt-12 text-center py-16 bg-white rounded-3xl border border-dashed border-slate-300 max-w-xl mx-auto p-8 shadow-sm">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">No books found</h3>
                <p class="text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                    We couldn't find any books matching your criteria. Try adjusting your search query or category filter.
                </p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                        View All Books
                    </a>
                </div>
            </div>
        @endif

        <!-- Categories Quick-Browse Section -->
        <div class="mt-20 pt-12 border-t border-slate-200">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-black text-slate-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Explore by Category
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Filter the entire collection by academic branch</p>
                </div>
                <a href="{{ route('client.categories') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                    View All Categories &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" class="group p-5 bg-white rounded-2xl border border-slate-200/90 hover:border-indigo-400 hover:shadow-lg transition-all text-center flex flex-col justify-between">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm mx-auto mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            {{ strtoupper(substr($category->name, 0, 2)) }}
                        </div>
                        <div class="font-bold text-sm text-slate-800 group-hover:text-indigo-600 transition line-clamp-1">
                            {{ $category->name }}
                        </div>
                        <div class="text-[11px] text-slate-400 mt-1 font-medium">
                            {{ $category->books_count ?? 0 }} {{ Str::plural('book', $category->books_count ?? 0) }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
