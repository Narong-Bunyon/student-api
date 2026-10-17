<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\BorrowingController;
use App\Http\Controllers\Web\UserController;
Route::get('/', function () {
    $search = request('search');
    $categoryId = request('category');

    $categories = \App\Models\Category::withCount('books')->get();
    
    $booksQuery = \App\Models\Book::with('category');
    if ($search) {
        $booksQuery->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('isbn', 'like', "%{$search}%");
        });
    }
    if ($categoryId) {
        $booksQuery->where('category_id', $categoryId);
    }
    
    $books = $booksQuery->latest()->paginate(9)->withQueryString();
    $totalBooks = \App\Models\Book::count();
    $totalCategories = \App\Models\Category::count();
    $totalBorrowings = \App\Models\Borrowing::count();

    return view('client.home', compact('books', 'categories', 'totalBooks', 'totalCategories', 'totalBorrowings'));
})->name('home');

// Client-facing Categories Page
Route::get('/categories-catalog', function () {
    $search = request('search');
    $query = \App\Models\Category::withCount('books');

    if ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    }

    $categories = $query->orderBy('name')->get();
    $totalCategories = \App\Models\Category::count();
    $totalBooks = \App\Models\Book::count();

    return view('client.categories', compact('categories', 'totalCategories', 'totalBooks'));
})->name('client.categories');

// Client-facing Book Detail Page
Route::get('/books-catalog/{book}', function (\App\Models\Book $book) {
    $book->load(['category', 'borrowings']);
    $relatedBooks = \App\Models\Book::where('category_id', $book->category_id)
        ->where('id', '!=', $book->id)
        ->take(4)
        ->get();
    $authorBooks = \App\Models\Book::where('author', $book->author)
        ->where('id', '!=', $book->id)
        ->take(4)
        ->get();

    return view('client.book-show', compact('book', 'relatedBooks', 'authorBooks'));
})->name('client.books.show');

// Client-facing Author Profile / Collection Page
Route::get('/authors/{author}', function ($author) {
    $decodedAuthor = urldecode($author);
    $books = \App\Models\Book::with('category')
        ->where('author', $decodedAuthor)
        ->latest()
        ->paginate(9);

    $totalAuthorBooks = \App\Models\Book::where('author', $decodedAuthor)->count();
    $categoriesCount = \App\Models\Book::where('author', $decodedAuthor)->distinct('category_id')->count('category_id');

    return view('client.author-show', compact('decodedAuthor', 'books', 'totalAuthorBooks', 'categoriesCount'));
})->name('client.authors.show');

// Client-facing My Borrowings (for logged-in student)
Route::middleware('auth')->get('/my-borrowings', function () {
    $userId = auth()->id();
    $filter = request('filter'); // 'active' or 'returned'

    $query = \App\Models\Borrowing::with(['book.category'])
        ->where('user_id', $userId);

    if ($filter === 'active') {
        $query->whereNull('returned_at');
    } elseif ($filter === 'returned') {
        $query->whereNotNull('returned_at');
    }

    $borrowings = $query->latest()->paginate(8)->withQueryString();

    $totalLoans = \App\Models\Borrowing::where('user_id', $userId)->count();
    $activeLoans = \App\Models\Borrowing::where('user_id', $userId)->whereNull('returned_at')->count();
    $returnedLoans = \App\Models\Borrowing::where('user_id', $userId)->whereNotNull('returned_at')->count();

    return view('client.my-borrowings', compact('borrowings', 'totalLoans', 'activeLoans', 'returnedLoans'));
})->name('client.my-borrowings');

// Client-facing About / Library Guidelines Page
Route::get('/about', function () {
    return view('client.about');
})->name('client.about');

Route::middleware(['auth', 'verified', 'can:admin'])->group(function () {
    Route::get('/dashboard', function () {
        $totalBooks = \App\Models\Book::count();
        $activeMembers = \App\Models\User::where('role', '!=', 'admin')->count();
        $borrowedBooks = \App\Models\Borrowing::whereNull('returned_at')->count();
        $overdueReturns = \App\Models\Borrowing::whereNull('returned_at')
            ->where('borrowed_at', '<', now()->subDays(14))
            ->count();

        // Categories breakdown
        $categoriesBreakdown = \App\Models\Category::withCount('books')
            ->orderByDesc('books_count')
            ->get();

        // Recent Borrowings
        $recentBorrowings = \App\Models\Borrowing::with(['book', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // Recent Books
        $recentBooks = \App\Models\Book::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'activeMembers',
            'borrowedBooks',
            'overdueReturns',
            'categoriesBreakdown',
            'recentBorrowings',
            'recentBooks'
        ));
    })->name('dashboard');

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('borrowings', BorrowingController::class);
    Route::resource('users', UserController::class)->middleware('can:admin');

    // Admin Reports & Analytics
    Route::get('/admin/reports', function () {
        $totalBooks = \App\Models\Book::count();
        $totalCategories = \App\Models\Category::count();
        $totalBorrowings = \App\Models\Borrowing::count();
        $activeBorrowings = \App\Models\Borrowing::whereNull('returned_at')->count();
        $returnedCount = \App\Models\Borrowing::whereNotNull('returned_at')->count();
        $overdueCount = \App\Models\Borrowing::whereNull('returned_at')
            ->where('borrowed_at', '<', now()->subDays(14))
            ->count();

        $circulationRate = $totalBooks > 0 ? round(($totalBorrowings / $totalBooks) * 100, 1) : 0;
        $returnRate = $totalBorrowings > 0 ? round(($returnedCount / $totalBorrowings) * 100, 1) : 0;

        $categoriesBreakdown = \App\Models\Category::withCount('books')
            ->orderByDesc('books_count')
            ->get();

        $topMembers = \App\Models\User::withCount('borrowings')
            ->where('role', '!=', 'admin')
            ->orderByDesc('borrowings_count')
            ->take(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalBooks',
            'totalCategories',
            'totalBorrowings',
            'activeBorrowings',
            'returnedCount',
            'overdueCount',
            'circulationRate',
            'returnRate',
            'categoriesBreakdown',
            'topMembers'
        ));
    })->name('admin.reports');

    // Admin Profile
    Route::get('/admin/profile', function () {
        $user = auth()->user();
        $totalBooks = \App\Models\Book::count();
        $totalMembers = \App\Models\User::where('role', '!=', 'admin')->count();
        $totalBorrowings = \App\Models\Borrowing::count();

        return view('admin.profile.index', compact('user', 'totalBooks', 'totalMembers', 'totalBorrowings'));
    })->name('admin.profile');

    // Admin Settings
    Route::get('/admin/settings', function () {
        return view('admin.settings.index');
    })->name('admin.settings');

    Route::post('/admin/settings/system', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'system_name' => 'required|string|max:100',
            'system_tagline' => 'nullable|string|max:150',
            'system_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        \App\Models\Setting::set('system_name', $validated['system_name']);
        if (isset($validated['system_tagline'])) {
            \App\Models\Setting::set('system_tagline', $validated['system_tagline']);
        }

        if ($request->hasFile('system_logo')) {
            $path = $request->file('system_logo')->store('system', 'public');
            \App\Models\Setting::set('system_logo', $path);
        }

        return redirect()->route('admin.settings')->with('success', 'System logo and branding updated successfully! Changes are applied across both the website and admin dashboard.');
    })->name('admin.settings.system.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
