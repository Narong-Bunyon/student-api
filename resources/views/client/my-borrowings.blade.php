@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800">
    <!-- Hero Banner with Gradient -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-16 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 backdrop-blur-md mb-5">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Student Portal &bull; Loan History
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                My Borrowed <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 via-sky-300 to-indigo-200">Books</span>
            </h1>

            <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Review your active library checkouts, return deadlines, and completed reading records at a glance.
            </p>

            <div class="mt-6 flex justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-xs sm:text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 backdrop-blur-md transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Browse &amp; Request More Books
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Quick Cards -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-9 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <!-- Active Loans -->
            <a href="{{ route('client.my-borrowings', ['filter' => 'active']) }}" class="group bg-white rounded-2xl p-6 shadow-xl border {{ request('filter') === 'active' ? 'border-amber-400 ring-2 ring-amber-400/20' : 'border-slate-200/90 hover:border-amber-300' }} transition flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wider font-bold text-slate-500">Currently Borrowed</div>
                    <div class="text-3xl font-black text-slate-900 mt-1">{{ $activeLoans ?? 0 }}</div>
                    <div class="text-xs font-semibold text-amber-600 mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        Active checkout
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-black text-xl group-hover:scale-105 transition-transform">
                    📖
                </div>
            </a>

            <!-- Returned Books -->
            <a href="{{ route('client.my-borrowings', ['filter' => 'returned']) }}" class="group bg-white rounded-2xl p-6 shadow-xl border {{ request('filter') === 'returned' ? 'border-emerald-400 ring-2 ring-emerald-400/20' : 'border-slate-200/90 hover:border-emerald-300' }} transition flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wider font-bold text-slate-500">Returned Books</div>
                    <div class="text-3xl font-black text-slate-900 mt-1">{{ $returnedLoans ?? 0 }}</div>
                    <div class="text-xs font-semibold text-emerald-600 mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Completed returns
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black text-xl group-hover:scale-105 transition-transform">
                    ✅
                </div>
            </a>

            <!-- Total Lifetime Loans -->
            <a href="{{ route('client.my-borrowings') }}" class="group bg-white rounded-2xl p-6 shadow-xl border {{ !request('filter') ? 'border-indigo-400 ring-2 ring-indigo-400/20' : 'border-slate-200/90 hover:border-indigo-300' }} transition flex items-center justify-between">
                <div>
                    <div class="text-xs uppercase tracking-wider font-bold text-slate-500">Total Borrow History</div>
                    <div class="text-3xl font-black text-slate-900 mt-1">{{ $totalLoans ?? 0 }}</div>
                    <div class="text-xs font-semibold text-indigo-600 mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                        All recorded loans
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xl group-hover:scale-105 transition-transform">
                    📚
                </div>
            </a>
        </div>
    </section>

    <!-- Borrowing Records Table & Filters -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filter Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-200 gap-4 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">
                    Loan Status Log
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    Viewing {{ $borrowings->total() }} recorded {{ Str::plural('entry', $borrowings->total()) }}
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('client.my-borrowings') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold {{ !request('filter') ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} transition">
                    All ({{ $totalLoans ?? 0 }})
                </a>
                <a href="{{ route('client.my-borrowings', ['filter' => 'active']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold {{ request('filter') === 'active' ? 'bg-amber-500 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} transition">
                    Active ({{ $activeLoans ?? 0 }})
                </a>
                <a href="{{ route('client.my-borrowings', ['filter' => 'returned']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold {{ request('filter') === 'returned' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} transition">
                    Returned ({{ $returnedLoans ?? 0 }})
                </a>
            </div>
        </div>

        <!-- Overdue Alert Banner for Late Books -->
        @php
            $overdueCount = $borrowings->filter(function($b) {
                $due = $b->due_at ? \Carbon\Carbon::parse($b->due_at) : ($b->borrowed_at ? \Carbon\Carbon::parse($b->borrowed_at)->addDays(14) : null);
                return !$b->returned_at && $due && $due->isPast();
            })->count();
        @endphp

        @if($overdueCount > 0)
            <div class="mb-6 p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-rose-500/10 via-red-500/10 to-rose-500/15 border-2 border-rose-500/40 shadow-sm flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-rose-500/30">
                    <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-black uppercase tracking-wider bg-rose-600 text-white shadow-sm">
                            🚩 RED FLAG WARNING
                        </span>
                        <span class="text-xs font-bold text-rose-700">Urgent Return Required</span>
                    </div>
                    <h3 class="text-base font-extrabold text-rose-900 mt-1">
                        You have {{ $overdueCount }} {{ Str::plural('book', $overdueCount) }} past due date!
                    </h3>
                    <p class="text-xs text-rose-700/90 mt-0.5">
                        Please return late books to the school library immediately to avoid penalties or account suspension.
                    </p>
                </div>
            </div>
        @endif

        @if($borrowings->count() > 0)
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                <th class="px-6 py-4">Book Information</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Borrowed On</th>
                                <th class="px-6 py-4">Return / Due Date</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($borrowings as $borrowing)
                                @php
                                    $borrowedDate = $borrowing->borrowed_at ?? $borrowing->created_at;
                                    $dueDate = $borrowing->due_at 
                                        ? \Carbon\Carbon::parse($borrowing->due_at) 
                                        : ($borrowedDate ? \Carbon\Carbon::parse($borrowedDate)->copy()->addDays(14) : null);
                                    $isOverdue = !$borrowing->returned_at && $dueDate && $dueDate->isPast();
                                @endphp
                                <tr class="transition-colors {{ $isOverdue ? 'bg-rose-50/40 hover:bg-rose-50/70 border-l-4 border-l-rose-500' : 'hover:bg-slate-50/70' }}">
                                    <!-- Book Info -->
                                    <td class="px-6 py-4">
                                        <div class="font-bold {{ $isOverdue ? 'text-rose-950 flex items-center gap-2' : 'text-slate-900' }}">
                                            @if($isOverdue)
                                                <span class="text-sm" title="Overdue Warning">🚩</span>
                                            @endif
                                            <span>{{ $borrowing->book->title ?? 'Book #' . $borrowing->book_id }}</span>
                                        </div>
                                        <div class="text-xs text-slate-500 mt-0.5 flex items-center gap-2">
                                            <span>By {{ $borrowing->book->author ?? 'Unknown' }}</span>
                                            @if(!empty($borrowing->book->isbn))
                                                <span>&bull;</span>
                                                <span class="font-mono text-[11px]">ISBN: {{ $borrowing->book->isbn }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                            {{ $borrowing->book->category->name ?? 'General' }}
                                        </span>
                                    </td>

                                    <!-- Borrow Date -->
                                    <td class="px-6 py-4 text-slate-700 font-mono text-xs">
                                        {{ $borrowedDate ? \Carbon\Carbon::parse($borrowedDate)->format('M d, Y') : '—' }}
                                    </td>

                                    <!-- Return / Due Date -->
                                    <td class="px-6 py-4 text-xs font-mono">
                                        @if($borrowing->returned_at)
                                            <span class="text-emerald-700 font-medium">
                                                {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('M d, Y') }}
                                            </span>
                                            <span class="block text-[10px] text-emerald-600 font-sans mt-0.5">Returned</span>
                                        @elseif($dueDate)
                                            <div class="{{ $isOverdue ? 'text-rose-700 font-bold' : 'text-slate-700' }}">
                                                <span class="inline-flex items-center gap-1">
                                                    @if($isOverdue)
                                                        <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                                    @endif
                                                    {{ $dueDate->format('M d, Y') }}
                                                </span>
                                                @if($isOverdue)
                                                    <span class="block text-[10px] text-rose-600 font-sans font-extrabold uppercase mt-0.5 tracking-wider">
                                                        ⚠️ {{ $dueDate->diffForHumans() }} (LATE)
                                                    </span>
                                                @else
                                                    <span class="block text-[10px] text-slate-400 font-sans mt-0.5">({{ $dueDate->diffForHumans() }})</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-slate-400">—</span>
                                        @endif
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-6 py-4 text-center">
                                        @if($borrowing->returned_at)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                Returned
                                            </span>
                                        @elseif($isOverdue)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-red-100 text-red-800 border-2 border-red-300 shadow-sm animate-pulse">
                                                <span>🚩</span>
                                                <span>OVERDUE LATE</span>
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                                Active Loan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($borrowings->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                        {{ $borrowings->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty state -->
            <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center max-w-lg mx-auto">
                <div class="w-16 h-16 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">No borrowings found</h3>
                <p class="text-sm text-slate-500 mt-1">
                    @if(request('filter'))
                        You don't have any loans matching this filter.
                    @else
                        You haven't borrowed any books from the library yet.
                    @endif
                </p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold text-sm hover:bg-indigo-700 transition">
                        Browse Book Catalog
                    </a>
                </div>
            </div>
        @endif
    </section>
</div>
@endsection
