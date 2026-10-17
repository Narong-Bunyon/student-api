
    @extends('layouts.app')

    @section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
    @endsection

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Category List</h3>
                    <a href="{{ route('categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add New Category</a>
                </div>
                @if($categories->count())
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">ID</th>
                                <th class="px-4 py-2 border-b">Name</th>
                                <th class="px-4 py-2 border-b">Description</th>
                                <th class="px-4 py-2 border-b">Books Count</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-4 py-2 border-b">{{ $category->id }}</td>
                                    <td class="px-4 py-2 border-b">{{ $category->name }}</td>
                                    <td class="px-4 py-2 border-b">{{ $category->description }}</td>
                                    <td class="px-4 py-2 border-b">{{ $category->books_count }}</td>
                                    <td class="px-4 py-2 border-b">
                                        <a href="{{ route('categories.show', $category) }}" class="text-indigo-600 hover:underline">View</a>
                                        |
                                        <a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                @else
                    <p class="text-gray-600">No categories found.</p>
                @endif
            </div>
        </div>
    @endsection
</body>
</html>
