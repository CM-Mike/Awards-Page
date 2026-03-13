<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NominationController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminNomineeController;
use App\Http\Controllers\Admin\CategoryController;


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

// Redirect /admin to login
Route::get('/login', function () { return redirect()->route('admin.login'); })->name('login'); 
Route::get('/admin', function () { return redirect()->route('admin.login'); });

// Show login form
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');

// Login submission
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

// Logout
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Events CRUD
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');

    // Profile
    Route::get('/profile', [AdminController::class, 'editProfile'])->name('admin.profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

    // Add user
    Route::get('/add-user', [AdminController::class, 'addUserForm'])->name('admin.addUser');
    Route::post('/add-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');

    // Categories
    Route::view('/categories', 'admin.categories.index')->name('admin.categories');

  Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('admin.categories.index');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('categories', [CategoryController::class,'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryController::class,'store'])->name('admin.categories.store');
});

    // Nominees
    Route::view('/nominees', 'admin.nominees.index')->name('admin.nominees');
});
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Nominees routes
    Route::get('/nominees', [AdminNomineeController::class, 'index'])->name('nominees.index');
    Route::post('/nominees', [AdminNomineeController::class, 'store'])->name('nominees.store');
    Route::delete('/nominees/{id}', [AdminNomineeController::class, 'destroy'])->name('nominees.destroy');

});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/nominees', [AdminNomineeController::class, 'index'])->name('admin.nominees');
});


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [EventController::class, 'home'])->name('home');
Route::get('/home', [EventController::class, 'home']);

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// About
Route::view('/about', 'events.about')->name('about');

// Contact
Route::view('/contact', 'events.contact')->name('contact');

// Nomination form
Route::get('/nomination', [NominationController::class, 'create'])->name('nomination.create');
Route::post('/nomination', [NominationController::class, 'store'])->name('nomination.store');

Route::get('/nominations', [NominationController::class, 'index'])->name('nominations.index');
Route::post('/nominations', [NominationController::class, 'store'])->name('nomination.store');

// Nominate by category
Route::get('/nomination/{slug}', [EventController::class, 'nominateCategory'])->name('nominate');

Route::get('/nomination/payment/{nominee_id}', function($nominee_id){
    $nominee = \App\Models\Nomination::findOrFail($nominee_id);
    return view('events.nomination_payment', compact('nominee'));
})->name('nomination.pay');

Route::post('/nomination/payment/{nominee_id}', [NominationController::class, 'processPayment'])->name('nomination.pay.process');