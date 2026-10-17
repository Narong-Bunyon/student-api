@extends('admin.layout')

@section('content')
    <!-- Page Title & Date Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard</h2>
            <p class="text-sm text-slate-500 mt-0.5">Welcome back, Admin! Here's what's happening in your library today.</p>
        </div>
        <div class="flex items-center gap-2.5 text-slate-600 bg-white px-3.5 py-2 rounded-xl border border-slate-200/80 shadow-sm text-xs font-semibold self-start sm:self-auto">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>{{ now()->format('M d, Y') }} &bull; {{ now()->format('l') }}</span>
        </div>
    </div>

    <!-- 4 Top Stat Cards matching mockup -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- Total Books -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Books</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $totalBooks }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>+5 new this month</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>

        <!-- Active Members -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Active Members</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $activeMembers }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>+3 new this month</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Borrowed Books -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Borrowed Books</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $borrowedBooks }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-emerald-600 mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>+8% this month</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
            </div>
        </div>

        <!-- Overdue Returns -->
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-start justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Overdue Returns</span>
                <div class="text-3xl font-extrabold text-slate-800 mt-2">{{ $overdueReturns }}</div>
                <div class="flex items-center gap-1 text-[11px] font-semibold text-rose-500 mt-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    <span>-2 less than last month</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Charts Row matching mockup -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
        <!-- Chart 1: Book Borrowing Overview (7 Cols) -->
        <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        <span>Book Borrowing Overview</span>
                    </h3>
                    <div class="flex items-center gap-4 text-xs font-semibold mt-1">
                        <span class="flex items-center gap-1.5 text-slate-500">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#5b51d8]"></span> Borrowed
                        </span>
                        <span class="flex items-center gap-1.5 text-slate-500">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#a5b4fc]"></span> Returned
                        </span>
                    </div>
                </div>
                <div class="text-xs bg-slate-50 text-slate-500 px-3 py-1.5 rounded-lg border border-slate-200/60 font-semibold">
                    Last 7 days
                </div>
            </div>
            <div class="h-56 relative w-full">
                <canvas id="borrowingChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Books by Category Donut (5 Cols) -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                    <span>Books by Category</span>
                </h3>
            </div>
            <div class="flex items-center justify-between gap-4 my-auto">
                <div class="h-44 w-44 relative shrink-0">
                    <canvas id="categoryDonutChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-2xl font-black text-slate-800 leading-tight">{{ $totalBooks }}</span>
                        <span class="text-[9px] uppercase tracking-wider text-slate-400 font-bold">Total Books</span>
                    </div>
                </div>
                <!-- Category Legend List -->
                <div class="flex-1 space-y-2 text-xs font-semibold pr-2">
                    @forelse($categoriesBreakdown->take(5) as $idx => $cat)
                        @php
                            $colors = ['bg-[#5b51d8]', 'bg-[#38bdf8]', 'bg-[#818cf8]', 'bg-[#fbbf24]', 'bg-[#34d399]'];
                            $color = $colors[$idx % count($colors)];
                        @endphp
                        <div class="flex items-center justify-between text-slate-600">
                            <span class="flex items-center gap-2 truncate max-w-[130px]">
                                <span class="w-2 h-2 rounded-full {{ $color }} shrink-0"></span>
                                <span class="truncate">{{ $cat->name }}</span>
                            </span>
                            <span class="text-slate-800 font-bold">{{ $cat->books_count }}</span>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400">No categories found</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Recent Books Table (Left) & Recent Borrowings (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column: Recent Books Table (8 cols) -->
        <div class="lg:col-span-8 bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    <h3 class="text-sm font-bold text-slate-800">Recent Books</h3>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('books.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">View All</a>
                    <a href="{{ route('books.create') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#4b3ecb] text-white text-xs font-bold hover:bg-[#3f32b6] transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Add Book</span>
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-slate-400 font-semibold border-b border-slate-100 uppercase tracking-wider">
                            <th class="py-2.5 px-3 text-center w-8">#</th>
                            <th class="py-2.5 px-3">Cover</th>
                            <th class="py-2.5 px-3">Title</th>
                            <th class="py-2.5 px-3">Author</th>
                            <th class="py-2.5 px-3">Category</th>
                            <th class="py-2.5 px-3 text-center">Copies</th>
                            <th class="py-2.5 px-3 text-center">Available</th>
                            <th class="py-2.5 px-3 text-center">Status</th>
                            <th class="py-2.5 px-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($recentBooks as $index => $book)
                            <tr class="hover:bg-slate-50/60 transition group">
                                <td class="py-3 px-3 text-center text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3 px-3">
                                    @if($book->image)
                                        <img src="{{ Str::startsWith($book->image, 'http') ? $book->image : asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-7 h-10 object-cover rounded shadow-sm" />
                                    @else
                                        <div class="w-7 h-10 rounded bg-indigo-50 border border-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                            {{ substr($book->title, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-3 font-bold text-slate-800 truncate max-w-[140px]">
                                    <a href="{{ route('client.books.show', $book) }}" class="hover:text-indigo-600 transition">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td class="py-3 px-3 text-slate-500 truncate max-w-[100px]">{{ $book->author }}</td>
                                <td class="py-3 px-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        {{ $book->category->name ?? 'General' }}
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-center font-semibold text-slate-800">10</td>
                                <td class="py-3 px-3 text-center font-semibold text-slate-800">8</td>
                                <td class="py-3 px-3 text-center">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                                        Available
                                    </span>
                                </td>
                                <td class="py-3 px-3 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('books.edit', $book) }}" class="text-slate-400 hover:text-indigo-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-rose-600 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-6 text-slate-400">No books found in the library.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Column: Recent Borrowings + Quick Actions -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Recent Borrowings Card -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-sm font-bold text-slate-800">Recent Borrowings</h3>
                    </div>
                    <a href="{{ route('borrowings.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">View All</a>
                </div>

                <!-- List of Borrowings with Covers & Status Pills -->
                <div class="space-y-3.5">
                    @forelse($recentBorrowings as $borrow)
                        <div class="flex items-center justify-between gap-3 p-2 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($borrow->book && $borrow->book->image)
                                    <img src="{{ Str::startsWith($borrow->book->image, 'http') ? $borrow->book->image : asset('storage/' . $borrow->book->image) }}" alt="{{ $borrow->book->title }}" class="w-9 h-12 object-cover rounded shadow-sm shrink-0" />
                                @else
                                    <div class="w-9 h-12 bg-indigo-50 border border-indigo-100 rounded text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ $borrow->book ? substr($borrow->book->title, 0, 1) : 'B' }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 truncate leading-snug">{{ $borrow->book->title ?? 'Unknown Book' }}</h4>
                                    <p class="text-[11px] text-slate-500 truncate flex items-center gap-1 mt-0.5">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span>{{ $borrow->user->name ?? 'Student' }}</span>
                                    </p>
                                    <div class="flex items-center gap-1 text-[10px] text-slate-400 mt-0.5">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ $borrow->borrowed_at ? \Carbon\Carbon::parse($borrow->borrowed_at)->format('M d, Y') : now()->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="shrink-0 text-right">
                                @if($borrow->returned_at)
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Returned
                                    </span>
                                @else
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                        Borrowed
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-xs text-center py-6 text-slate-400">No recent borrowings recorded.</div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Management Shortcuts Card -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)]">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-2.5">
                    <!-- Add Book -->
                    <a href="{{ route('books.create') }}" class="p-3.5 rounded-xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 transition group flex flex-col justify-between">
                        <div class="w-8 h-8 rounded-lg bg-[#5b51d8] text-white flex items-center justify-center mb-2 shadow-sm group-hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 group-hover:text-indigo-600 transition">Add Book</div>
                            <div class="text-[10px] text-slate-500">Insert new library item</div>
                        </div>
                    </a>

                    <!-- Add Member -->
                    <a href="{{ route('users.create') }}" class="p-3.5 rounded-xl bg-sky-50/70 hover:bg-sky-100/70 border border-sky-100 transition group flex flex-col justify-between">
                        <div class="w-8 h-8 rounded-lg bg-sky-500 text-white flex items-center justify-center mb-2 shadow-sm group-hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 group-hover:text-sky-600 transition">Add Member</div>
                            <div class="text-[10px] text-slate-500">Register a new member</div>
                        </div>
                    </a>

                    <!-- New Borrowing -->
                    <a href="{{ route('borrowings.create') }}" class="p-3.5 rounded-xl bg-emerald-50/70 hover:bg-emerald-100/70 border border-emerald-100 transition group flex flex-col justify-between">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center mb-2 shadow-sm group-hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 group-hover:text-emerald-600 transition">New Borrowing</div>
                            <div class="text-[10px] text-slate-500">Process a book loan</div>
                        </div>
                    </a>

                    <!-- Manage Categories -->
                    <a href="{{ route('categories.index') }}" class="p-3.5 rounded-xl bg-amber-50/70 hover:bg-amber-100/70 border border-amber-100 transition group flex flex-col justify-between">
                        <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center mb-2 shadow-sm group-hover:scale-105 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 group-hover:text-amber-600 transition">Categories</div>
                            <div class="text-[10px] text-slate-500">Manage book sections</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Line Chart: Book Borrowing Overview
            const borrowingCanvas = document.getElementById('borrowingChart');
            if (borrowingCanvas) {
                const ctxBorrowing = borrowingCanvas.getContext('2d');
                new Chart(ctxBorrowing, {
                    type: 'line',
                    data: {
                        labels: ['Oct 7', 'Oct 8', 'Oct 9', 'Oct 10', 'Oct 11', 'Oct 12', 'Oct 13'],
                        datasets: [
                            {
                                label: 'Borrowed',
                                data: [7, 9, 8, 14, 9, 7, 14],
                                borderColor: '#5b51d8',
                                backgroundColor: 'rgba(91, 81, 216, 0.08)',
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#5b51d8',
                                pointRadius: 3
                            },
                            {
                                label: 'Returned',
                                data: [4, 5, 4, 7, 6, 5, 8],
                                borderColor: '#a5b4fc',
                                backgroundColor: 'transparent',
                                tension: 0.4,
                                borderDash: [4, 4],
                                pointBackgroundColor: '#a5b4fc',
                                pointRadius: 2.5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 10 }, color: '#94a3b8' }
                            },
                            y: {
                                min: 0,
                                max: 20,
                                ticks: { stepSize: 5, font: { size: 10 }, color: '#94a3b8' },
                                grid: { color: '#f1f5f9' }
                            }
                        }
                    }
                });
            }

            // 2. Donut Chart: Books by Category
            const categoryCanvas = document.getElementById('categoryDonutChart');
            if (categoryCanvas) {
                const ctxCategory = categoryCanvas.getContext('2d');
                const categoryLabels = {!! json_encode($categoriesBreakdown->pluck('name')) !!};
                const categoryData = {!! json_encode($categoriesBreakdown->pluck('books_count')) !!};

                new Chart(ctxCategory, {
                    type: 'doughnut',
                    data: {
                        labels: categoryLabels.length ? categoryLabels : ['Fiction', 'Science', 'Technology', 'History', 'Health'],
                        datasets: [{
                            data: categoryData.length && categoryData.some(v => v > 0) ? categoryData : [42, 28, 24, 18, 15],
                            backgroundColor: [
                                '#5b51d8',
                                '#38bdf8',
                                '#818cf8',
                                '#fbbf24',
                                '#34d399',
                                '#94a3b8'
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '72%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.label + ': ' + context.raw + ' books';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush
