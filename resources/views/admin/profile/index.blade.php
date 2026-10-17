@extends('admin.layout')

@section('content')
    <!-- Admin Profile Hero Card -->
    <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-[#231e54] via-[#3b2f99] to-[#5b51d8] text-white p-8 sm:p-10 mb-8 shadow-2xl">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#a5b4fc_1px,transparent_1px)] [background-size:18px_18px]"></div>
        <div class="absolute -top-20 -right-20 w-72 h-72 bg-indigo-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-sky-400/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start gap-6">
            <!-- Avatar -->
            <div class="w-28 h-28 rounded-3xl bg-white/10 border-2 border-white/20 shadow-2xl shadow-indigo-900/40 overflow-hidden shrink-0 flex items-center justify-center">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover" />
                @else
                    <span class="text-5xl font-black text-white/90">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>

            <div class="text-center sm:text-left flex-1">
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight">{{ $user->name }}</h1>
                <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-3 text-sm text-indigo-200">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $user->email }}
                    </span>
                    <span class="text-indigo-400/60">&bull;</span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-white/15 text-xs font-bold capitalize">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ $user->role ?? 'Administrator' }}
                    </span>
                </div>
                <p class="mt-2 text-xs text-indigo-300/80">Member since {{ $user->created_at ? $user->created_at->format('F d, Y') : 'N/A' }}</p>

                <!-- Quick Stats -->
                <div class="mt-5 flex flex-wrap items-center justify-center sm:justify-start gap-4">
                    <div class="bg-white/10 backdrop-blur rounded-2xl px-5 py-3 border border-white/10">
                        <div class="text-2xl font-black">{{ $totalBooks ?? 0 }}</div>
                        <div class="text-[10px] text-indigo-300 font-semibold uppercase tracking-wider">Books</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-2xl px-5 py-3 border border-white/10">
                        <div class="text-2xl font-black">{{ $totalMembers ?? 0 }}</div>
                        <div class="text-[10px] text-indigo-300 font-semibold uppercase tracking-wider">Members</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-2xl px-5 py-3 border border-white/10">
                        <div class="text-2xl font-black">{{ $totalBorrowings ?? 0 }}</div>
                        <div class="text-[10px] text-indigo-300 font-semibold uppercase tracking-wider">Borrowings</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Account Info & Tip -->
        <div class="space-y-6">
            <!-- Account Status Card -->
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-200/90">
                <h3 class="text-sm font-extrabold text-slate-900 mb-5 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    Account Status
                </h3>

                <div class="space-y-4 text-xs">
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-slate-400 font-medium">Email Status</span>
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-1 font-bold text-emerald-600">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </span>
                        @else
                            <span class="font-bold text-amber-600">Unverified</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-slate-400 font-medium">Role</span>
                        <span class="font-bold text-indigo-700 capitalize bg-indigo-50 px-2.5 py-0.5 rounded-full">{{ $user->role ?? 'admin' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                        <span class="text-slate-400 font-medium">Account Created</span>
                        <span class="font-medium text-slate-700">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 font-medium">Last Updated</span>
                        <span class="font-medium text-slate-700">{{ $user->updated_at ? $user->updated_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-200/90">
                <h3 class="text-sm font-extrabold text-slate-900 mb-4 flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 text-xs font-semibold transition group">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Go to Dashboard
                    </a>
                    <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 text-xs font-semibold transition group">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        System Settings & Logo
                    </a>
                    <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 text-xs font-semibold transition group">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Reports & Analytics
                    </a>
                </div>
            </div>

            <!-- Guidance Note -->
            <div class="bg-gradient-to-br from-indigo-50 to-sky-50 rounded-3xl p-6 border border-indigo-100">
                <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold mb-3 shadow-md shadow-indigo-600/30">
                    🛡️
                </div>
                <h4 class="font-bold text-slate-900 text-sm">Security Tip</h4>
                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                    Use a strong, unique password for your admin account. Consider changing your password periodically for enhanced security.
                </p>
            </div>
        </div>

        <!-- Right Column: Forms -->
        <div class="lg:col-span-2 space-y-8">
            <!-- 1. Update Profile Information Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/90">
                <div class="flex items-center gap-3 pb-6 border-b border-slate-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Personal Information</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Update your display name, email address, and profile photo.</p>
                    </div>
                </div>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Profile Photo -->
                    <div>
                        <label for="admin_profile_photo" class="block text-sm font-semibold text-slate-700 mb-2">Profile Photo</label>
                        <div class="flex items-center gap-5" x-data="{ photoName: null, photoPreview: null }">
                            <div class="shrink-0">
                                <template x-if="photoPreview">
                                    <span class="block w-20 h-20 rounded-2xl bg-cover bg-no-repeat bg-center shadow-lg border-2 border-indigo-400"
                                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </template>
                                <template x-if="!photoPreview">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-2xl object-cover shadow-lg border-2 border-indigo-200">
                                    @else
                                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-[#231e54] to-[#5b51d8] text-white flex items-center justify-center font-black text-2xl shadow-lg">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </template>
                            </div>

                            <div class="flex-1">
                                <input
                                    type="file"
                                    id="admin_profile_photo"
                                    name="profile_photo"
                                    accept="image/png, image/jpeg, image/jpg, image/webp"
                                    class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer transition"
                                    x-ref="photo"
                                    x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                    "
                                />
                                <p class="text-[11px] text-slate-400 mt-1.5">PNG, JPG, or WEBP. Max 2MB.</p>
                            </div>
                        </div>
                        @error('profile_photo')
                            <p class="mt-2 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="admin_name" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                        <input type="text" id="admin_name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                               class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                        @error('name')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="admin_email" class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" id="admin_email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                               class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                        @error('email')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2">
                                <p class="text-sm text-slate-700">
                                    Your email address is unverified.
                                    <button form="send-verification" class="underline text-sm text-indigo-600 hover:text-indigo-800 rounded-md font-semibold">
                                        Click here to re-send verification email.
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-emerald-600">A new verification link has been sent.</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-bold text-white bg-[#4b3ecb] hover:bg-[#3b2fb5] shadow-md shadow-indigo-500/20 transition-all hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Save Changes
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                               class="text-sm font-semibold text-emerald-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Profile Updated!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- 2. Update Password Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-200/90">
                <div class="flex items-center gap-3 pb-6 border-b border-slate-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Security & Password</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Ensure your admin account uses a strong, unique password.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="admin_current_password" class="block text-sm font-semibold text-slate-700 mb-1.5">Current Password</label>
                        <input type="password" id="admin_current_password" name="current_password" autocomplete="current-password"
                               class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                        @error('current_password', 'updatePassword')
                            <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="admin_password" class="block text-sm font-semibold text-slate-700 mb-1.5">New Password</label>
                            <input type="password" id="admin_password" name="password" autocomplete="new-password"
                                   class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                            @error('password', 'updatePassword')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="admin_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm New Password</label>
                            <input type="password" id="admin_password_confirmation" name="password_confirmation" autocomplete="new-password"
                                   class="w-full px-4 py-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-bold text-white bg-sky-600 hover:bg-sky-700 shadow-md shadow-sky-500/20 transition-all hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Update Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                               class="text-sm font-semibold text-emerald-600 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Password Updated!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- 3. Danger Zone -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-rose-200/80">
                <div class="flex items-center gap-3 pb-6 border-b border-rose-100 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-rose-900">Danger Zone</h3>
                        <p class="text-xs text-rose-600/80 mt-0.5">Permanently remove your admin account and all associated data.</p>
                    </div>
                </div>

                <div class="bg-rose-50/60 rounded-2xl p-5 border border-rose-100">
                    <p class="text-xs text-rose-700/90 leading-relaxed mb-4">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </p>

                    <div x-data="{ confirmDelete: false }">
                        <button @click="confirmDelete = true" x-show="!confirmDelete"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-md shadow-rose-500/20 transition-all hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete Account
                        </button>

                        <form method="post" action="{{ route('profile.destroy') }}" x-show="confirmDelete" x-transition class="space-y-4">
                            @csrf
                            @method('delete')

                            <p class="text-xs text-rose-800 font-bold">Please enter your password to confirm deletion:</p>
                            <input type="password" name="password" required placeholder="Enter your password..."
                                   class="w-full max-w-sm px-4 py-3 text-sm bg-white border border-rose-200 rounded-xl focus:border-rose-400 focus:ring-2 focus:ring-rose-100 text-slate-800 placeholder-slate-400 outline-none transition" />
                            @error('password', 'userDeletion')
                                <p class="text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="flex items-center gap-3">
                                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-md transition">
                                    Confirm Delete
                                </button>
                                <button type="button" @click="confirmDelete = false" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
