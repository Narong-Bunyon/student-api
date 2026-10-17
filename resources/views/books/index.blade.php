<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Glassmorphism Container -->
            <div class="bg-white/30 dark:bg-gray-800/50 backdrop-blur-md border border-white/20 dark:border-gray-700/50 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-emerald-400">Library Books</h3>
                        <a href="{{ route('books.create') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300">
                            + Add New Book
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 bg-emerald-500/20 border border-emerald-500/50 text-emerald-700 dark:text-emerald-300 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('books.index') }}" method="GET" class="mb-6">
                        <div class="flex gap-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author..." class="w-full px-4 py-2 rounded-lg bg-white/50 dark:bg-gray-900/50 border border-gray-300/50 dark:border-gray-600/50 focus:ring-2 focus:ring-blue-500 outline-none backdrop-blur-sm transition-all text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                            <button type="submit" class="px-6 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-lg shadow hover:bg-gray-700 dark:hover:bg-white transition-colors">Search</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto rounded-lg border border-gray-200/50 dark:border-gray-700/50">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100/50 dark:bg-gray-900/50 backdrop-blur-md">
                                    <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Title</th>
                                    <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Author</th>
                                    <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">Category</th>
                                    <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">ISBN</th>
                                    <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                @forelse($books as $book)
                                    <tr class="hover:bg-white/40 dark:hover:bg-gray-800/40 transition-colors duration-200">
                                        <td class="py-4 px-6">{{ $book->title }}</td>
                                        <td class="py-4 px-6">{{ $book->author }}</td>
                                        <td class="py-4 px-6">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                                {{ $book->category->name }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-500 dark:text-gray-400">{{ $book->isbn }}</td>
                                        <td class="py-4 px-6 text-right space-x-2">
                                            <a href="{{ route('books.edit', $book) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500 dark:text-gray-400">No books found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
