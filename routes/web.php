<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NominationController;
use App\Http\Controllers\Admin\{
    DashboardController,
    AdminEventController,
    AdminController,
    AuthController,
    AdminNomineeController,
    CategoryController
};

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');
Route::get('/admin', fn() => redirect()->route('admin.login'));

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes (Unified Group)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Events CRUD
    Route::get('/events', [AdminEventController::class, 'index'])->name('events');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // Categories Management
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    // Nominees Management
    Route::get('/nominees', [AdminNomineeController::class, 'index'])->name('nominees.index');
    Route::post('/nominees', [AdminNomineeController::class, 'store'])->name('nominees.store');
    Route::delete('/nominees/{id}', [AdminNomineeController::class, 'destroy'])->name('nominees.destroy');

    // Profile & User Management
    Route::get('/profile', [AdminController::class, 'editProfile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/add-user', [AdminController::class, 'addUserForm'])->name('addUser');
    Route::post('/add-user', [AdminController::class, 'storeUser'])->name('storeUser');
});

/*
|--------------------------------------------------------------------------
| Website Routes (Public)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [EventController::class, 'home'])->name('home');
Route::get('/home', [EventController::class, 'home']);

// THE MISSING LINK: Public Categories Page
Route::get('/categories', [EventController::class, 'categoriesPage'])->name('categories.index');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// About & Contact
Route::view('/about', 'events.about')->name('about');
Route::view('/contact', 'events.contact')->name('contact');

// Nomination logic
Route::get('/nominations', [NominationController::class, 'index'])->name('nominations.index');
Route::get('/nomination', [NominationController::class, 'create'])->name('nomination.create');
Route::post('/nomination', [NominationController::class, 'store'])->name('nomination.store');

// Nominate by category (slug)
Route::get('/nomination/{slug}', [EventController::class, 'nominateCategory'])->name('nominate');

// Payment
Route::get('/nomination/payment/{nominee_id}', function($nominee_id){
    $nominee = \App\Models\Nomination::findOrFail($nominee_id);
    return view('events.nomination_payment', compact('nominee'));
})->name('nomination.pay');

Route::post('/nomination/payment/{nominee_id}', [NominationController::class, 'processPayment'])->name('nomination.pay.process');