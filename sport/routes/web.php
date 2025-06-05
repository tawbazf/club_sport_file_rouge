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

Route::get('/', [PublicController::class, 'services'])->name('public.home');
Route::get('/classes', [PublicController::class, 'services'])->name('public.classes');
Route::get('/coaches', [PublicController::class, 'services'])->name('public.coaches');
Route::get('/schedule', [PublicController::class, 'schedule'])->name('public.schedule');
Route::post('/contact', [PublicController::class, 'contact'])->name('public.contact');

Route::get('/login', fn() => view('auth.signup'))->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', fn() => view('admin.members.index'))->name('admin.dashboard');
        Route::resource('members', MemberController::class);
        Route::resource('coaches', CoachController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('invoices', InvoiceController::class);
        Route::get('/reports', [AttendanceController::class, 'index'])->name('attendances.index');
    });

    Route::prefix('coach')->middleware('role:coach')->group(function () {
        Route::get('/dashboard', [SessionController::class, 'index'])->name('coach.dashboard');
        Route::get('/sessions', [SessionController::class, 'index'])->name('coach.sessions');
        Route::get('/schedule', [SessionController::class, 'index'])->name('coach.schedule');
    });

    Route::prefix('member')->middleware('role:member')->group(function () {
        Route::get('/dashboard', [ReservationController::class, 'index'])->name('member.dashboard');
        Route::get('/classes', [ReservationController::class, 'index'])->name('member.classes');
        Route::get('/bookings', [ReservationController::class, 'index'])->name('member.bookings');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('member.invoices');
    });

    Route::resource('sessions', SessionController::class)->only(['index', 'show']);
});