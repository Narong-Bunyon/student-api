@extends('admin.layout')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('borrowings.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Borrowings</span>
            </a>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Edit Borrowing Record</h2>
            <p class="text-sm text-slate-500 mt-0.5">Update loan info or mark the book as returned.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">
            <form method="POST" action="{{ route('borrowings.update', $borrowing) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Member *</label>
                    <select name="user_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition bg-white">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $borrowing->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Book *</label>
                    <select name="book_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition bg-white">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id', $borrowing->book_id) == $book->id ? 'selected' : '' }}>
                                {{ $book->title }} ({{ $book->author }})
                            </option>
                        @endforeach
                    </select>
                    @error('book_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Status *</label>
                    <select name="status" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition bg-white">
                        <option value="pending" {{ old('status', $borrowing->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $borrowing->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="cancel" {{ old('status', $borrowing->status) == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    </select>
                    @error('status') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Borrowed Date *</label>
                        <input type="date" name="borrowed_at" value="{{ old('borrowed_at', $borrowing->borrowed_at ? \Carbon\Carbon::parse($borrowing->borrowed_at)->format('Y-m-d') : '') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                        @error('borrowed_at') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Due Date (Optional)</label>
                        <input type="date" name="due_at" value="{{ old('due_at', $borrowing->due_at ? \Carbon\Carbon::parse($borrowing->due_at)->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                        @error('due_at') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Returned Date (Mark Returned)</label>
                        <input type="date" name="returned_at" value="{{ old('returned_at', $borrowing->returned_at ? \Carbon\Carbon::parse($borrowing->returned_at)->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                        @error('returned_at') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('borrowings.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#4b3ecb] hover:bg-[#3f32b6] text-white text-xs font-bold shadow-lg shadow-indigo-900/20 transition transform active:scale-95">
                        Update Borrowing
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
