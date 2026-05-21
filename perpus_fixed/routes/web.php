<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User;
use App\Http\Controllers\Admin\BookProposalController;

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ─── USER ROUTES ──────────────────────────────────────────────────────────────
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/dashboard', [User\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/books',                [User\BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}',         [User\BookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/collect',[User\BookController::class, 'toggleCollection'])->name('books.collect');

    Route::get('/borrow/create',                        [User\BorrowingController::class, 'create'])->name('borrow.create');
    Route::post('/borrow',                              [User\BorrowingController::class, 'store'])->name('borrow.store');
    Route::post('/borrow/{borrowing}/return',           [User\BorrowingController::class, 'submitReturn'])->name('borrow.return');
    Route::post('/borrow/{borrowing}/review',           [User\BorrowingController::class, 'storeReview'])->name('borrow.review');
    Route::get('/borrow/{borrowing}/receipt',           [User\BorrowingController::class, 'printBorrowReceipt'])->name('borrow.receipt');
    Route::get('/borrow/{borrowing}/return-receipt',    [User\BorrowingController::class, 'printReturnReceipt'])->name('borrow.return-receipt');

    Route::delete('/reviews/{review}', [User\ReviewController::class, 'destroy'])->name('review.destroy');

    Route::get('/profile',           [User\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile',          [User\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [User\ProfileController::class, 'changePassword'])->name('profile.password');
});

// ─── ADMIN / PETUGAS ROUTES ───────────────────────────────────────────────────
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/books/proposals', [BookProposalController::class, 'index'])->name('books.proposals.index');
    Route::get('/books/proposals/create', [BookProposalController::class, 'create'])->name('books.proposals.create');
    Route::post('/books/proposals', [BookProposalController::class, 'store'])->name('books.proposals.store');
    Route::get('/books/proposals/{proposal}', [BookProposalController::class, 'show'])->name('books.proposals.show');
    Route::post('/books/proposals/{proposal}/approve', [BookProposalController::class, 'approve'])->name('books.proposals.approve');
    Route::post('/books/proposals/{proposal}/reject', [BookProposalController::class, 'reject'])->name('books.proposals.reject');
    Route::delete('/books/proposals/{proposal}', [BookProposalController::class, 'destroy'])->name('books.proposals.destroy');

    Route::resource('books', Admin\BookController::class);

    Route::get('/categories',               [Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories',              [Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}',    [Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/users',                    [Admin\UserController::class, 'index'])->name('users.index');
    Route::post('/users',                   [Admin\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}',             [Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',          [Admin\UserController::class, 'destroy'])->name('users.destroy');
    // FIX: Route baru untuk toggle aktif/nonaktif — hanya admin
    Route::post('/users/{user}/activate',   [Admin\UserController::class, 'activate'])->name('users.activate');

    Route::get('/borrowings',                             [Admin\BorrowingController::class, 'index'])->name('borrowings.index');
    Route::post('/borrowings/{borrowing}/approve',        [Admin\BorrowingController::class, 'approveBorrow'])->name('borrowings.approve');
    Route::post('/borrowings/{borrowing}/reject',         [Admin\BorrowingController::class, 'rejectBorrow'])->name('borrowings.reject');
    Route::post('/borrowings/{borrowing}/approve-return', [Admin\BorrowingController::class, 'approveReturn'])->name('borrowings.approve-return');
    Route::post('/borrowings/{borrowing}/reject-return',  [Admin\BorrowingController::class, 'rejectReturn'])->name('borrowings.reject-return');

    Route::get('/reviews',             [Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::get('/reports',            [Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/books',      [Admin\ReportController::class, 'books'])->name('reports.books');
    Route::get('/reports/borrowings', [Admin\ReportController::class, 'borrowings'])->name('reports.borrowings');
    Route::get('/reports/users',      [Admin\ReportController::class, 'users'])->name('reports.users');
    Route::get('/reports/staff',      [Admin\ReportController::class, 'staff'])->name('reports.staff');
    Route::post('/borrowings/{borrowing}/note', [Admin\BorrowingController::class, 'addNote'])->name('borrowings.note');
});
