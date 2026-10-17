@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800">
    <!-- Hero Banner with Modern Gradient & Depth -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-20 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-200 border border-indigo-400/30 backdrop-blur-md mb-6">
                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Campus Academic Resource Center
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                Empowering Students Through <br class="hidden sm:inline" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-sky-300 to-teal-200">
                    Accessible Knowledge
                </span>
            </h1>

            <p class="mt-6 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                StudentLib is our university's central digital and physical library system, built to streamline catalog exploration, scholarly research, and student book circulation.
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Explore Library Catalog
                </a>
                <a href="{{ route('client.categories') }}" class="px-6 py-3 rounded-xl font-bold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/15 backdrop-blur-md transition-all duration-200">
                    View Categories
                </a>
            </div>
        </div>
    </section>

    <!-- Key Metrics Highlight Section -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-200/80 text-center">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-3 font-black text-xl">
                    📚
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900">Curated</div>
                <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 mt-1">Multi-Category Books</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-200/80 text-center">
                <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mx-auto mb-3 font-black text-xl">
                    ⏱️
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900">14 Days</div>
                <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 mt-1">Loan Period</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-200/80 text-center">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-3 font-black text-xl">
                    ⚡
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900">Instant</div>
                <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 mt-1">Digital Tracking</div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-200/80 text-center">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mx-auto mb-3 font-black text-xl">
                    🎓
                </div>
                <div class="text-2xl sm:text-3xl font-black text-slate-900">100% Free</div>
                <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 mt-1">For All Students</div>
            </div>
        </div>
    </section>

    <!-- Mission & What We Do -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200">
                    Our Mission
                </span>
                <h2 class="text-3xl font-black text-slate-900 mt-4 tracking-tight leading-snug">
                    Building a Smarter, Connected Reading Environment
                </h2>
                <p class="mt-4 text-slate-600 text-base leading-relaxed">
                    The Student Library Management System was designed to eliminate paperwork and long queues. We bridge students with essential learning resources through a transparent digital catalog, simplified desk borrowing, and automatic return date notifications.
                </p>

                <div class="mt-8 space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            ✓
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Digital Catalog Browsing</h4>
                            <p class="text-slate-500 text-xs mt-0.5">Filter by book category, author, title, or ISBN anytime from any device.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            ✓
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Real-time Student Loan Tracking</h4>
                            <p class="text-slate-500 text-xs mt-0.5">Students can monitor active borrowings, due dates, and past completed loans in their portal.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            ✓
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Admin Control &amp; Inventory Accuracy</h4>
                            <p class="text-slate-500 text-xs mt-0.5">Librarians manage categories, book availability, and student check-ins with single-click actions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Feature Box -->
            <div class="bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-900 rounded-3xl p-8 sm:p-10 text-white shadow-2xl border border-slate-800 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <h3 class="text-xl font-extrabold text-white mb-2">How Borrowing Works</h3>
                <p class="text-sm text-slate-300 mb-8">Follow this simple 3-step workflow to check out books.</p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl bg-indigo-500 text-white font-bold flex items-center justify-center text-sm shadow-md shadow-indigo-500/40 shrink-0">
                            1
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-sm">Find Your Book Online</h5>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                                Use the search bar on our home page to look up titles, authors, and verify available book copies.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl bg-sky-500 text-white font-bold flex items-center justify-center text-sm shadow-md shadow-sky-500/40 shrink-0">
                            2
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-sm">Present Student ID at Desk</h5>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                                Visit the library counter. The librarian will scan the book and link it to your student profile.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white font-bold flex items-center justify-center text-sm shadow-md shadow-emerald-500/40 shrink-0">
                            3
                        </div>
                        <div>
                            <h5 class="font-bold text-white text-sm">Track &amp; Return</h5>
                            <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                                Check the "My Borrowings" page for your return schedule and bring the book back within 14 days.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Library Rules & Policies Grid -->
    <section class="bg-white border-y border-slate-200 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-200">
                    Guidelines
                </span>
                <h2 class="text-3xl font-black text-slate-900 mt-3 tracking-tight">
                    Library Policies &amp; Borrowing Code
                </h2>
                <p class="text-slate-500 text-sm mt-2">
                    Please review our guidelines to ensure fair and organized access for every student.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Policy 1 -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/90 hover:border-indigo-300 hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Loan Limits &amp; Duration</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Undergraduate students may borrow up to <strong>3 books</strong> simultaneously for a standard duration of <strong>14 calendar days</strong>.
                    </p>
                </div>

                <!-- Policy 2 -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/90 hover:border-indigo-300 hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Renewals &amp; Extensions</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Books can be renewed once for an extra 7 days if no other student has requested a reservation on that specific title.
                    </p>
                </div>

                <!-- Policy 3 -->
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/90 hover:border-indigo-300 hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Care &amp; Overdue Items</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Please keep books in clean condition. Lost or damaged books must be reported immediately to the desk for replacement procedures.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Operating Schedule & Helpdesk Contact -->
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-slate-900 rounded-3xl text-white p-8 sm:p-12 shadow-2xl relative overflow-hidden flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
            <div class="max-w-xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-400/30 mb-3">
                    Campus Library Desk
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Need Help or Have Inquiries?
                </h3>
                <p class="mt-3 text-slate-400 text-sm leading-relaxed">
                    Our reference librarians are ready to assist you with book reservations, catalog search assistance, or research databases.
                </p>

                <div class="mt-6 flex flex-wrap gap-6 text-sm text-slate-300">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Mon – Fri: 8:00 AM – 6:00 PM</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>library@university.edu</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 font-bold text-sm text-center shadow-lg shadow-indigo-600/30 transition">
                    Browse Books Now
                </a>
                <a href="{{ route('client.categories') }}" class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 font-bold text-sm text-center border border-slate-700 transition">
                    Explore Categories
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
