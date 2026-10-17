<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('book_id')) {
            $query->where('book_id', $request->book_id);
        }

        $borrowings = $query->paginate($request->get('per_page', 10));
        return response()->json($borrowings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        $borrowing = Borrowing::create($validated);
        return response()->json($borrowing, 201);
    }

    public function show(Borrowing $borrowing)
    {
        return response()->json($borrowing->load(['user', 'book']));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'book_id' => 'sometimes|exists:books,id',
            'borrowed_at' => 'sometimes|date',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        $borrowing->update($validated);
        return response()->json($borrowing);
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();
        return response()->json(null, 204);
    }
}
