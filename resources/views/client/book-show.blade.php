@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Catalog</a>
            <span>&rsaquo;</span>
            <a href="{{ route('client.categories') }}" class="hover:text-indigo-600 transition">{{ $book->category->name ?? 'Category' }}</a>
            <span>&rsaquo;</span>
            <span class="text-slate-800 font-semibold truncate">{{ $book->title }}</span>
        </nav>

        <!-- Main Book Hero Card -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xl overflow-hidden p-6 sm:p-10 mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                
                <!-- Book Cover Mockup / Badge Box -->
                <div class="lg:col-span-4 flex flex-col items-center">
                    <div class="w-full max-w-xs aspect-[3/4] rounded-2xl bg-gradient-to-br from-indigo-700 via-indigo-900 to-slate-900 text-white shadow-2xl flex flex-col justify-between border border-indigo-400/20 relative overflow-hidden group">
                        @if(!empty($book->image))
                            <img src="{{ $book->image }}" alt="{{ $book->title }}" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                        @else
                            <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:12px_12px]"></div>
                        @endif
                        
                        <div class="relative z-10 p-5">
                            <span class="inline-block px-2.5 py-1 text-[11px] font-bold rounded-lg bg-slate-900/80 backdrop-blur-md text-white uppercase tracking-wider">
                                {{ $book->category->name ?? 'Book' }}
                            </span>
                        </div>

                        <div class="relative z-10 p-5 mt-auto">
                            <h2 class="text-lg font-black text-white leading-snug line-clamp-2 drop-shadow-md">
                                {{ $book->title }}
                            </h2>
                            <p class="text-xs text-indigo-200 mt-1 font-medium drop-shadow">
                                {{ $book->author }}
                            </p>
                            <div class="flex items-center justify-between text-[11px] text-indigo-200/80 font-mono border-t border-white/20 pt-2 mt-3">
                                <span>ISBN: {{ $book->isbn }}</span>
                                <span>#{{ $book->id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Indicator -->
                    <div class="w-full max-w-xs mt-4">
                        <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-xs font-semibold">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Physical Copy Available</span>
                            </div>
                            <span class="text-[11px] text-emerald-700 font-normal">Desk Checkout</span>
                        </div>
                    </div>
                </div>

                <!-- Book Information & Author Section -->
                <div class="lg:col-span-8 flex flex-col justify-between h-full">
                    <div>
                        <!-- Category Pill -->
                        <div class="flex items-center gap-2 mb-3">
                            <a href="{{ route('home', ['category' => $book->category_id]) }}" class="px-3 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 hover:bg-indigo-100 transition">
                                {{ $book->category->name ?? 'General Literature' }}
                            </a>
                            <span class="text-xs text-slate-400 font-mono">ISBN: {{ $book->isbn }}</span>
                        </div>

                        <!-- Book Title -->
                        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                            {{ $book->title }}
                        </h1>

                        <!-- Author Card / Profile Row -->
                        <div class="mt-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/90 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-md shadow-indigo-600/30">
                                    {{ strtoupper(substr($book->author, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="text-[11px] uppercase tracking-wider font-bold text-slate-400">Written By</div>
                                    <h3 class="text-base font-bold text-slate-900">
                                        {{ $book->author }}
                                    </h3>
                                </div>
                            </div>
                            <a href="{{ route('client.authors.show', urlencode($book->author)) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 text-indigo-600 hover:text-indigo-700 hover:border-indigo-300 text-xs font-bold shadow-sm transition">
                                View Author Profile &amp; Books
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>

                        <!-- Book Metadata Grid -->
                        <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <div class="text-[11px] font-semibold text-slate-400 uppercase">Publication Date</div>
                                <div class="text-sm font-bold text-slate-800 mt-0.5">
                                    {{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('M d, Y') : 'Unknown' }}
                                </div>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200">
                                <div class="text-[11px] font-semibold text-slate-400 uppercase">Standard Loan Period</div>
                                <div class="text-sm font-bold text-slate-800 mt-0.5">
                                    14 Days Allowed
                                </div>
                            </div>
                            <div class="p-3.5 rounded-xl bg-white border border-slate-200 col-span-2 sm:col-span-1">
                                <div class="text-[11px] font-semibold text-slate-400 uppercase">Campus Location</div>
                                <div class="text-sm font-bold text-slate-800 mt-0.5">
                                    Main Shelf #{{ $book->category_id }}
                                </div>
                            </div>
                        </div>

                        <!-- Description Placeholder -->
                        <div class="mt-6">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Book Overview</h4>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                This academic resource is cataloged under {{ $book->category->name ?? 'General' }}. Recommended for students, researchers, and faculty pursuing coursework or independent reading in this discipline.
                            </p>
                        </div>
                    </div>

                    <!-- Call To Action -->
                    <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-slate-500">
                            Present your student ID at the library desk to register this checkout.
                        </div>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <a href="{{ route('home') }}" class="w-full sm:w-auto text-center px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                                &larr; Back to Catalog
                            </a>
                            @auth
                                <a href="{{ route('client.my-borrowings') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/20 transition">
                                    Check My Active Loans
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-600/20 transition">
                                    Login to View Loans
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- More Books By This Author -->
        @if($authorBooks->count() > 0)
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                        <span>More by Author:</span>
                        <span class="text-indigo-600">{{ $book->author }}</span>
                    </h3>
                    <a href="{{ route('client.authors.show', urlencode($book->author)) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                        View All ({{ $authorBooks->count() + 1 }}) &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($authorBooks as $otherBook)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm hover:shadow-lg hover:border-indigo-300 transition flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-indigo-50 text-indigo-700">
                                    {{ $otherBook->category->name ?? 'Book' }}
                                </span>
                                <h4 class="font-bold text-slate-900 text-base mt-2 line-clamp-2">
                                    {{ $otherBook->title }}
                                </h4>
                                <p class="text-xs text-slate-400 font-mono mt-2">ISBN: {{ $otherBook->isbn }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] text-emerald-600 font-semibold">Available</span>
                                <a href="{{ route('client.books.show', $otherBook) }}" class="text-xs font-bold text-indigo-600 hover:underline">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Related Books in Same Category -->
        @if($relatedBooks->count() > 0)
            <div>
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                        <span>Related in</span>
                        <span class="text-indigo-600">{{ $book->category->name ?? 'Category' }}</span>
                    </h3>
                    <a href="{{ route('home', ['category' => $book->category_id]) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                        Browse Category &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedBooks as $relBook)
                        <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-sm hover:shadow-lg hover:border-indigo-300 transition flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-700">
                                    {{ $relBook->author }}
                                </span>
                                <h4 class="font-bold text-slate-900 text-base mt-2 line-clamp-2">
                                    {{ $relBook->title }}
                                </h4>
                                <p class="text-xs text-slate-400 font-mono mt-2">ISBN: {{ $relBook->isbn }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] text-emerald-600 font-semibold">Available</span>
                                <a href="{{ route('client.books.show', $relBook) }}" class="text-xs font-bold text-indigo-600 hover:underline">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
