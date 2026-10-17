@extends('admin.layout')

@section('content')
    <!-- Page Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Borrowing Records</h2>
            <p class="text-sm text-slate-500 mt-0.5">Track book loan status, member return dates, and overdue records.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('borrowings.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#4b3ecb] hover:bg-[#3f32b6] text-white text-xs font-bold shadow-lg shadow-indigo-900/20 transition transform active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>New Borrowing</span>
            </a>
        </div>
    </div>

    <!-- Borrowing Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Borrowings</span>
                <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ $borrowings->total() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Currently Borrowed</span>
                <div class="text-2xl font-extrabold text-amber-600 mt-1">{{ \App\Models\Borrowing::whereNull('returned_at')->count() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Returned Books</span>
                <div class="text-2xl font-extrabold text-emerald-600 mt-1">{{ \App\Models\Borrowing::whereNotNull('returned_at')->count() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Borrowings Table Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-400 font-semibold uppercase tracking-wider">
                        <th class="py-3.5 px-4 text-center w-12">#ID</th>
                        <th class="py-3.5 px-4">Book Title</th>
                        <th class="py-3.5 px-4">Member / User</th>
                        <th class="py-3.5 px-4 text-center">Borrowed Date</th>
                        <th class="py-3.5 px-4 text-center">Return Status</th>
                        <th class="py-3.5 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($borrowings as $borrowing)
                        <tr class="hover:bg-slate-50/60 transition group">
                            <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                                #{{ $borrowing->id }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    @if($borrowing->book && $borrowing->book->image)
                                        <img src="{{ Str::startsWith($borrowing->book->image, 'http') ? $borrowing->book->image : asset('storage/' . $borrowing->book->image) }}" alt="{{ $borrowing->book->title }}" class="w-8 h-11 object-cover rounded shadow-sm border border-slate-100 shrink-0" />
                                    @else
                                        <div class="w-8 h-11 rounded bg-indigo-50 border border-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ $borrowing->book ? substr($borrowing->book->title, 0, 1) : 'B' }}
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <span class="font-bold text-slate-800 block truncate max-w-xs">{{ $borrowing->book->title ?? 'Unknown Book' }}</span>
                                        <span class="text-[10px] text-slate-400">{{ $borrowing->book->author ?? 'Unknown Author' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                                        {{ substr($borrowing->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-700 block">{{ $borrowing->user->name ?? 'Guest User' }}</span>
                                        <span class="text-[10px] text-slate-400 block">{{ $borrowing->user->email ?? 'No email' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-center text-slate-600">
                                {{ $borrowing->borrowed_at ? \Carbon\Carbon::parse($borrowing->borrowed_at)->format('M d, Y') : ($borrowing->created_at ? $borrowing->created_at->format('M d, Y') : '-') }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($borrowing->returned_at)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Returned ({{ \Carbon\Carbon::parse($borrowing->returned_at)->format('M d') }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Active Loan
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('borrowings.edit', $borrowing) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition" title="Update Borrowing">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" class="inline" onsubmit="return confirm('Delete this borrowing entry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-slate-400">No borrowing records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($borrowings->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $borrowings->links() }}
            </div>
        @endif
    </div>
@endsection
