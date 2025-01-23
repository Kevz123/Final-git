<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubOwnerController;
use App\Http\Controllers\ClubController;
use App\Http\Middleware\IsClubOwner;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RemoveController;
use App\Http\Controllers\PaymentController;




// welocme page route
Route::get('/', [HomeController::class, 'index'])->name('home');

//dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegistrationController::class, 'register']);

// Authenticated routes group with additional role-based dashboards
Route::middleware('auth')->group(function () {
    // Admin Dashboard
    Route::prefix('admin')->middleware('is_admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    });

    // Club Owner Dashboard
    Route::prefix('club-owner')->middleware([IsClubOwner::class])->group(function () {
        // Club Owner Dashboard
        Route::get('/dashboard', [ClubOwnerController::class, 'dashboard'])->name('clubowner.dashboard');
        
        // Club Owner Club Management
        Route::get('/clubs', [ClubOwnerController::class, 'myClubs'])->name('clubowner.clubs');
        Route::get('/clubs/register', [ClubController::class, 'register'])->name('clubs.register');
        Route::post('/clubs', [ClubController::class, 'store'])->name('clubs.store');

         // Event Routes for Club Owner
         Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
         Route::post('/events', [EventController::class, 'store'])->name('events.store');
 

    });
});

// Clubs Discover route
Route::get('/discover', [ClubController::class, 'discover'])->name('clubs.discover');



Route::middleware(['web'])->group(function () {
    Route::get('/clubs/my', [ClubController::class, 'myClubs'])->name('clubs.my');
    // other routes
});

Route::get('/clubs/physical', [ClubController::class, 'showPhysicalClubs'])->name('clubs.physical');
Route::get('/clubs/non-physical', [ClubController::class, 'showNonPhysicalClubs'])->name('clubs.nonPhysical');
Route::get('/clubs/join/{club_id}', [ClubController::class, 'show'])->name('clubs.show');
Route::post('/clubs/join/{club_id}', [ClubController::class, 'join'])->name('clubs.join');

// Include additional authentication routes
require __DIR__.'/auth.php';



Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');



//Venue Routes
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
Route::post('/venues/select', [VenueController::class, 'selectVenue'])->name('venues.select');


//Event Routes
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/reserve', [EventController::class, 'reserve'])->name('events.reserve')->middleware('auth');

Route::get('/equipment/book', [LocationController::class, 'book'])->name('equipment.book'); // For book view
Route::post('/locations/store', [LocationController::class, 'store'])->name('locations.store'); // For adding locations
Route::get('/equipment/show/{id}', [LocationController::class, 'show'])->name('equipment.show'); // For showing specific location
Route::post('/bookings/store', [EquipmentController::class, 'storeBooking'])->name('bookings.store');
// Club routes
//Route::get('/my-clubs', [ClubController::class, 'myClubs'])->name('clubs.my');


Route::get('/clubs/physical', [ClubController::class, 'physical'])->name('clubs.physical');
Route::get('/clubs/non-physical', [ClubController::class, 'nonPhysical'])->name('clubs.nonPhysical');


//News Routes
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
Route::post('/submit-event', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
Route::delete('/news/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.remove');

//Comment Route
Route::post('/clubs/{club_id}/comment', [ClubController::class, 'storeComment'])->name('clubs.storeComment');

//Payment Routes
Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession'])->name('payment.create');
Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession']);
Route::get('/payment/success/{club_id}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

