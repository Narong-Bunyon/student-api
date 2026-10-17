@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800">
    <!-- Author Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-900 text-white py-16 px-4 sm:px-6 lg:px-8 shadow-2xl">
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#818cf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <!-- Author Avatar -->
            <div class="w-20 h-20 rounded-3xl bg-gradient-to-tr from-indigo-500 to-sky-400 text-white flex items-center justify-center font-black text-3xl mx-auto mb-4 shadow-xl shadow-indigo-500/30 border border-white/20">
                {{ strtoupper(substr($decodedAuthor, 0, 1)) }}
            </div>

            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-200 border border-indigo-400/30 backdrop-blur-md mb-2">
                Author Collection
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                {{ $decodedAuthor }}
            </h1>

            <p class="mt-3 text-slate-300 text-sm max-w-xl mx-auto leading-relaxed">
                Explore all academic textbooks, monographs, and research literature authored or co-authored by {{ $decodedAuthor }} in our university library.
            </p>

            <div class="mt-6 flex items-center justify-center gap-6 text-xs text-indigo-200 border-t border-indigo-800/50 pt-5 max-w-xs mx-auto">
                <div>
                    <span class="font-bold text-white text-base">{{ $totalAuthorBooks }}</span>
                    <span class="block text-[11px] uppercase tracking-wider text-slate-400">Works in Library</span>
                </div>
                <div class="h-6 w-px bg-indigo-800"></div>
                <div>
                    <span class="font-bold text-white text-base">{{ $categoriesCount }}</span>
                    <span class="block text-[11px] uppercase tracking-wider text-slate-400">Disciplines</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Books Collection Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between pb-6 border-b border-slate-200 mb-8">
            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Published Titles ({{ $books->total() }})
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Select a book below to view shelf location and borrow information.
                </p>
            </div>
            <a href="{{ route('home') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                &larr; Back to Catalog
            </a>
        </div>

        @if($books->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($books as $book)
                    <div class="group bg-white rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-indigo-300 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2.5 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 rounded-lg border border-indigo-100">
                                    {{ $book->category->name ?? 'General' }}
                                </span>
                                <span class="text-[11px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">
                                    Available
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                <a href="{{ route('client.books.show', $book) }}">
                                    {{ $book->title }}
                                </a>
                            </h3>

                            <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-500">
                                <div class="flex justify-between">
                                    <span class="text-slate-400">ISBN:</span>
                                    <span class="font-mono font-medium text-slate-700">{{ $book->isbn }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-400">Published:</span>
                                    <span class="font-medium text-slate-700">
                                        {{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('M d, Y') : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-400">ID: #{{ $book->id }}</span>
                            <a href="{{ route('client.books.show', $book) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                                View Book Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($books->hasPages())
                <div class="mt-8">
                    {{ $books->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                <p class="text-slate-500 text-sm">No books found for this author.</p>
            </div>
        @endif
    </div>
</div>
@endsection
