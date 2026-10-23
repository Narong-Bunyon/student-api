<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Show form for student to request a borrowing.
     */
    public function createRequest()
    {
        // List books that are available (no active borrowing)
        $books = Book::whereDoesntHave('borrowings', function ($q) {
            $q->whereNull('returned_at');
        })->get();
        return view('client.borrowings.request', compact('books'));
    }

    /**
     * Store a borrowing request from a student.
     */
    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'nullable|date|after:borrowed_at',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';
        // Use provided due_at or calculate 14 days from borrowed_at
        if (empty($validated['due_at'])) {
            $validated['due_at'] = \Carbon\Carbon::parse($validated['borrowed_at'])->addDays(14)->format('Y-m-d');
        }


        Borrowing::create($validated);
        return redirect()->route('client.my-borrowings')
            ->with('success', 'Borrowing request submitted successfully.');
    }


    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->paginate(5)->withQueryString();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    /**
     * Return JSON data for admin dashboards.
     */
    public function adminData()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        $data = $borrowings->map(function ($b) {
            return [
                'id' => $b->id,
                'book_title' => $b->book->title ?? 'N/A',
                'user_name' => $b->user->name ?? 'N/A',
                'borrowed_at' => $b->borrowed_at ? $b->borrowed_at->format('Y-m-d') : null,
                'due_at' => $b->due_at ? $b->due_at->format('Y-m-d') : null,
                'status' => $b->status,
            ];
        })->toArray();
        return response()->json($data);
    }

    public function create()
    {
        $books = Book::all();
        $users = User::all();
        return view('admin.borrowings.create', compact('books', 'users'));
    }

    /**
     * Return JSON data for a regular user (student).
     */
    public function userData()
    {
        $userId = auth()->id();
        $borrowings = Borrowing::with('book')
            ->where('user_id', $userId)
            ->latest()
            ->get();
        $data = $borrowings->map(function ($b) {
            // calculate days left if due_at exists
            $daysLeft = null;
            if ($b->due_at) {
                $daysLeft = \Carbon\Carbon::parse($b->due_at)->diffInDays(now(), false);
            }
            return [
                'id' => $b->id,
                'book_title' => $b->book->title ?? 'N/A',
                'borrowed_at' => $b->borrowed_at ? $b->borrowed_at->format('Y-m-d') : null,
                'due_at' => $b->due_at ? $b->due_at->format('Y-m-d') : null,
                'days_left' => $daysLeft,
                'status' => $b->status,
            ];
        })->toArray();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'nullable|date|after:borrowed_at',
            'status' => 'nullable|in:pending,approved,cancel',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        // Default due_at to 14 days after borrowed_at if not provided
        if (empty($validated['due_at'])) {
            $validated['due_at'] = \Carbon\Carbon::parse($validated['borrowed_at'])->addDays(14)->format('Y-m-d');
        }

        // When created directly by admin, default status to 'approved'
        if (empty($validated['status'])) {
            $validated['status'] = 'approved';
        }

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
            'due_at' => 'nullable|date|after:borrowed_at',
            'status' => 'required|in:pending,approved,cancel',
            'returned_at' => 'nullable|date|after_or_equal:borrowed_at',
        ]);

        // Preserve existing due_at if not provided
        if (empty($validated['due_at'])) {
            $validated['due_at'] = $borrowing->due_at;
        }

        $borrowing->update($validated);
        $msg = $validated['returned_at'] ? 'Borrowing marked as returned.' : 'Borrowing updated successfully.';
        return redirect()->route('borrowings.index')
            ->with('success', $msg);


    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Borrowing deleted successfully.');
    }
}
