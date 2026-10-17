@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800 pb-16">
    <!-- Profile Hero Banner -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-16 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                <!-- Large Avatar with Uploaded Photo or Initial -->
                <div class="w-24 h-24 rounded-3xl bg-gradient-to-tr from-indigo-500 via-sky-400 to-indigo-600 text-white flex items-center justify-center font-black text-4xl shadow-2xl shadow-indigo-500/30 border-2 border-white/20 shrink-0 overflow-hidden">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 mb-2">
                        <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                            {{ $user->name }}
                        </h1>
                    </div>

                    <p class="text-sm text-slate-300 flex items-center justify-center sm:justify-start gap-2">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>{{ $user->email }}</span>
                        <span class="text-slate-600">&bull;</span>
                        <span class="text-xs text-slate-400">Member since {{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</span>
                    </p>

                    <!-- Profile Quick Actions -->
                    <div class="mt-6 flex flex-wrap items-center justify-center sm:justify-start gap-3">
                        <a href="{{ route('client.my-borrowings') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-white/10 hover:bg-white/20 text-white border border-white/15 backdrop-blur-md transition">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            My Borrowings Portal
                        </a>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-white/10 hover:bg-white/20 text-white border border-white/15 backdrop-blur-md transition">
                            Browse Book Catalog
                        </a>
                        @can('admin')
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-indigo-600 hover:bg-indigo-500 text-white shadow-md transition">
                                Admin Dashboard
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Account Quick Summary & Status -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-200/90">
                    <h3 class="text-base font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Account Status
                    </h3>

                    <div class="space-y-4 text-xs">
                        <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                            <span class="text-slate-400">Email Status</span>
                            @if($user->email_verified_at)
                                <span class="inline-flex items-center gap-1 font-semibold text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Verified
                                </span>
                            @else
                                <span class="font-semibold text-amber-600">Unverified</span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Member Since</span>
                            <span class="font-medium text-slate-700">{{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Guidance Note -->
                <div class="bg-gradient-to-br from-indigo-50 to-sky-50 rounded-3xl p-6 border border-indigo-100">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold mb-3 shadow-md shadow-indigo-600/30">
                        💡
                    </div>
                    <h4 class="font-bold text-slate-900 text-sm">Library Account Tip</h4>
                    <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                        Keep your email up-to-date so you never miss return due date reminders or reservation notifications from the campus desk.
                    </p>
                </div>
            </div>

            <!-- Right Column: Settings Forms -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- 1. Update Profile Info Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/90">
                    <div class="flex items-center gap-3 pb-6 border-b border-slate-100 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Personal Information</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Update your display name and university email address.</p>
                        </div>
                    </div>

                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- 2. Update Password Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/90">
                    <div class="flex items-center gap-3 pb-6 border-b border-slate-100 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Security &amp; Password</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Ensure your account uses a secure password to prevent unauthorized access.</p>
                        </div>
                    </div>

                    @include('profile.partials.update-password-form')
                </div>

                <!-- 3. Danger Zone / Delete Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-rose-200/80">
                    <div class="flex items-center gap-3 pb-6 border-b border-rose-100 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-rose-900">Danger Zone</h3>
                            <p class="text-xs text-rose-600/80 mt-0.5">Permanently remove your account and active session records.</p>
                        </div>
                    </div>

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
