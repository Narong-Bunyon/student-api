@extends('admin.layout')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-indigo-600 transition mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Back to Members</span>
            </a>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create Member</h2>
            <p class="text-sm text-slate-500 mt-0.5">Register a new reader or library staff member account.</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] p-6 sm:p-8">
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Full Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. John Doe" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Email Address *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                    @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Role *</label>
                        <select name="role" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition bg-white">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User / Member</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        @error('role') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Account Status *</label>
                        <select name="status" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition bg-white">
                            <option value="Pending" {{ old('status', 'Pending') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Verified" {{ old('status') === 'Verified' ? 'selected' : '' }}>Verified</option>
                            <option value="Cancel" {{ old('status') === 'Cancel' ? 'selected' : '' }}>Cancel</option>
                        </select>
                        @error('status') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Initial Password *</label>
                        <input type="password" name="password" required minlength="8" placeholder="At least 8 characters" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 outline-none transition" />
                        @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#4b3ecb] hover:bg-[#3f32b6] text-white text-xs font-bold shadow-lg shadow-indigo-900/20 transition transform active:scale-95">
                        Save Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
