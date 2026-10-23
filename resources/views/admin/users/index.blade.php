@extends('admin.layout')

@section('content')
    <!-- Page Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-7">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Members & Users</h2>
            <p class="text-sm text-slate-500 mt-0.5">Manage library registered members, assign roles, and review accounts.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#4b3ecb] hover:bg-[#3f32b6] text-white text-xs font-bold shadow-lg shadow-indigo-900/20 transition transform active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                <span>Add Member</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Members</span>
                <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ $users->total() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Administrators</span>
                <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Students & Readers</span>
                <div class="text-2xl font-extrabold text-slate-800 mt-1">{{ \App\Models\User::where('role', '!=', 'admin')->count() }}</div>
            </div>
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
    </div>

    <!-- Members Table Card -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-slate-400 font-semibold uppercase tracking-wider">
                        <th class="py-3.5 px-4 text-center w-14">#ID</th>
                        <th class="py-3.5 px-4">Member Info</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4 text-center">Role</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center">Joined Date</th>
                        <th class="py-3.5 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition group">
                            <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                                #{{ $user->id }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                <div class="flex items-center gap-3">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-200" />
                                    @else
                                        <div class="w-9 h-9 rounded-full bg-indigo-50 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="block text-slate-800 text-sm font-bold">{{ $user->name }}</span>
                                        <span class="block text-[10px] text-slate-400 font-normal">Registered User</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 font-mono text-[11px]">
                                {{ $user->email }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                                        Administrator
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                        Member
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @php
                                    $currentStatus = $user->status ?? ($user->email_verified_at ? 'Verified' : 'Pending');
                                @endphp
                                <form action="{{ route('users.update-status', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <div class="relative inline-block">
                                        <select name="status" 
                                                onchange="this.form.submit()" 
                                                class="text-[11px] font-bold rounded-full py-1 ps-3 pe-7 border cursor-pointer transition focus:outline-none focus:ring-2 focus:ring-offset-1
                                                @if($currentStatus === 'Verified')
                                                    bg-emerald-50 text-emerald-700 border-emerald-200 focus:ring-emerald-400
                                                @elseif($currentStatus === 'Cancel')
                                                    bg-rose-50 text-rose-700 border-rose-200 focus:ring-rose-400
                                                @else
                                                    bg-amber-50 text-amber-700 border-amber-200 focus:ring-amber-400
                                                @endif">
                                            <option value="Pending" {{ $currentStatus === 'Pending' ? 'selected' : '' }}>⏳ Pending</option>
                                            <option value="Verified" {{ $currentStatus === 'Verified' ? 'selected' : '' }}>✓ Verified</option>
                                            <option value="Cancel" {{ $currentStatus === 'Cancel' ? 'selected' : '' }}>✕ Cancel</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td class="py-3.5 px-4 text-center text-slate-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('users.edit', $user) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition" title="Edit Member">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    @if(Auth::id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Delete Member">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-slate-400">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
