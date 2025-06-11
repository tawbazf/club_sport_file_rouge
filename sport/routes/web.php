<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PublicController;
use App\Http\Middleware\RoleMiddleware;
Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('/classes', [PublicController::class, 'classes'])->name('public.classes');
Route::get('/coaches', [PublicController::class, 'coaches'])->name('public.coaches');
Route::get('/schedule', [PublicController::class, 'schedule'])->name('public.schedule');
Route::get('/contact', [PublicController::class, 'showContactForm'])->name('public.contact.form');
Route::post('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/subscriptions', [PublicController::class, 'subscriptions'])->name('public.subscriptions');

Route::get('/login', fn() => view('auth.signup'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
  Route::prefix('admin')->middleware(RoleMiddleware::middleware('admin'))->group(function () {
        Route::get('/dashboard', [MemberController::class, 'index'])->name('admin.dashboard');
        Route::resource('members', MemberController::class);
        Route::resource('coaches', CoachController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::get('/reports', [AttendanceController::class, 'index'])->name('attendances.index');
    });
Route::prefix('admin/coaches')
    ->middleware(['web', 'auth', RoleMiddleware::middleware('admin')])
    ->name('admin.coaches.')
    ->group(function () {
        Route::get('/', [CoachController::class, 'index'])->name('index');
        Route::get('/create', [CoachController::class, 'create'])->name('create');
        Route::post('/', [CoachController::class, 'store'])->name('store');
        Route::get('/{coach}', [CoachController::class, 'show'])->name('show');
        Route::get('/{coach}/edit', [CoachController::class, 'edit'])->name('edit');
        Route::put('/{coach}', [CoachController::class, 'update'])->name('update');
        Route::delete('/{coach}', [CoachController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('coach')->middleware(RoleMiddleware::middleware('coach'))->group(function () {
        Route::get('/dashboard', [SessionController::class, 'index'])->name('coach.dashboard');
        Route::get('/sessions', [SessionController::class, 'index'])->name('coach.sessions');
        Route::get('/schedule', [SessionController::class, 'index'])->name('coach.schedule');
    });


Route::prefix('admin/courses')->middleware(['web', 'auth', RoleMiddleware::middleware('admin')])->name('admin.courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/', [CourseController::class, 'store'])->name('store');
    Route::get('/{course}', [CourseController::class, 'show'])->name('show');
    Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('edit');
    Route::put('/{course}', [CourseController::class, 'update'])->name('update');
    Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
    Route::patch('/{course}/check-and-cancel', [CourseController::class, 'checkAndCancel'])->name('checkAndCancel');
});
    Route::prefix('member')->middleware(RoleMiddleware::middleware('member'))->group(function () {
        Route::get('/dashboard', [ReservationController::class, 'index'])->name('member.dashboard');
        Route::get('/classes', [ReservationController::class, 'index'])->name('member.classes');
        Route::get('/bookings', [ReservationController::class, 'index'])->name('member.bookings');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('member.invoices');
    });
    Route::prefix('member')->middleware(RoleMiddleware::middleware('member'))->group(function () {
        Route::post('/reservations', [ReservationController::class, 'store'])->name('member.reservations.store');
    });
    Route::resource('sessions', SessionController::class)->only(['index', 'show']);
});