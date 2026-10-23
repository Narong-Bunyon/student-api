<footer class="bg-slate-950 text-slate-300 border-t border-slate-900 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Col 1: Brand & Bio -->
            <div class="space-y-4">
                <div class="flex items-center gap-2.5">
                    @if(!empty($globalSystemLogo))
                        <div class="w-10 h-10 rounded-full bg-white/10 p-0.5 border border-indigo-400/40 shadow-lg shrink-0 overflow-hidden flex items-center justify-center">
                            <img src="{{ Str::startsWith($globalSystemLogo, 'http') ? $globalSystemLogo : asset('storage/' . $globalSystemLogo) }}" 
                                 alt="{{ $globalSystemName ?? 'Book Admin' }}" 
                                 class="w-full h-full rounded-full object-cover" />
                        </div>
                    @else
                        <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    @endif
                    <span class="font-extrabold text-xl tracking-tight text-white">
                        {{ $globalSystemName ?? 'Book Admin' }}
                    </span>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed">
                    A modern campus library management portal empowering students and staff to explore academic books, borrow study resources, and manage research materials seamlessly.
                </p>
                <div class="flex items-center gap-3 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Library System Online
                    </span>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">
                    Quick Navigation
                </h4>
                <ul class="space-y-2.5 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2">
                            <span class="text-slate-600">&rsaquo;</span> Home / Catalog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.categories') }}" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2">
                            <span class="text-slate-600">&rsaquo;</span> Book Categories
                        </a>
                    </li>
                    @auth
                    <li>
                        <a href="{{ route('client.my-borrowings') }}" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2">
                            <span class="text-slate-600">&rsaquo;</span> My Borrowings
                        </a>
                    </li>
                    @endauth
                    <li>
                        <a href="{{ route('client.about') }}" class="text-slate-400 hover:text-indigo-400 transition-colors flex items-center gap-2">
                            <span class="text-slate-600">&rsaquo;</span> Library Guidelines &amp; About
                        </a>
                    </li>
                    @can('admin')
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition-colors flex items-center gap-2">
                            <span class="text-indigo-500">&rsaquo;</span> Admin Dashboard
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>

            <!-- Col 3: Library Information -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">
                    Library Hours
                </h4>
                <div class="space-y-3 text-sm text-slate-400">
                    <div class="flex justify-between pb-2 border-b border-slate-900">
                        <span>Monday – Friday</span>
                        <span class="text-slate-200 font-mono text-xs">8:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between pb-2 border-b border-slate-900">
                        <span>Saturday</span>
                        <span class="text-slate-200 font-mono text-xs">9:00 AM - 1:00 PM</span>
                    </div>
                    <div class="flex justify-between pb-2 border-b border-slate-900">
                        <span>Sunday &amp; Holidays</span>
                        <span class="text-rose-400 font-medium text-xs">Closed</span>
                    </div>
                    <p class="text-xs text-slate-500 pt-1">
                        * Digital catalog access is available 24/7.
                    </p>
                </div>
            </div>

            <!-- Col 4: Contact & Help -->
            <div>
                <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">
                    Campus Helpdesk
                </h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Central Campus Building, Level 2, Room 204</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="font-mono text-xs">library@gmail.come</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="font-mono text-xs">(+855) 31-33-55-860</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom bar: Copyright & Status -->
        <div class="mt-12 pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <p>
                &copy; {{ date('Y') }} <strong class="text-slate-400">StudentLib</strong> Management System. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('client.about') }}" class="hover:text-slate-300 transition">Terms of Service</a>
                <a href="{{ route('client.about') }}" class="hover:text-slate-300 transition">Privacy Policy</a>
                <a href="{{ route('client.about') }}" class="hover:text-slate-300 transition">Library Rules</a>
            </div>
        </div>
    </div>
</footer>
