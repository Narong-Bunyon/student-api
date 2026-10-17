<!-- resources/views/borrowings/index.blade.php -->
{{-- Borrowings index view --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Borrowings</h1>

    @if ($borrowings->count())
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">#</th>
                    <th class="px-4 py-2 border-b">User</th>
                    <th class="px-4 py-2 border-b">Book</th>
                    <th class="px-4 py-2 border-b">Borrowed At</th>
                    <th class="px-4 py-2 border-b">Returned At</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrowings as $borrowing)
                    <tr class="odd:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $borrowing->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $borrowing->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border-b">{{ $borrowing->book->title ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border-b">{{ $borrowing->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 border-b">
                            {{ optional($borrowing->returned_at)->format('Y-m-d') ?? '–' }}
                        </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="text-blue-600 hover:underline mr-2">View</a>
                            <a href="{{ route('borrowings.edit', $borrowing) }}" class="text-indigo-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this borrowing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $borrowings->links() }}</div>
    @else
        <p class="text-gray-600">No borrowings found.</p>
    @endif
</div>
@endsection
