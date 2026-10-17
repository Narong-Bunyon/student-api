<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->paginate(10);
        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::all();
        $users = User::all();
        return view('admin.borrowings.create', compact('books', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        Borrowing::create($validated);
        return redirect()->route('borrowings.index')->with('success', 'Borrowing recorded successfully.');
    }

    public function show(Borrowing $borrowing)
    {
        return redirect()->route('borrowings.index');
    }

    public function edit(Borrowing $borrowing)
    {
        $books = Book::all();
        $users = User::all();
        return view('admin.borrowings.edit', compact('borrowing', 'books', 'users'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        $borrowing->update($validated);
        return redirect()->route('borrowings.index')->with('success', 'Borrowing updated successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Borrowing deleted successfully.');
    }
}
