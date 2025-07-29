<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use App\Models\Course;

// use App\Http\Controllers\JunkController;



// Route::post('purchase', [PurchaseController::class, 'singlePurchase'])->name('singlePurchase');
Route::get('/', [ContentController::class, 'home'])->name('page.home');
Route::get('about', [ContentController::class, 'about'])->name('page.about');
Route::get('books', [ContentController::class, 'books'])->name('page.books');
Route::get('events', [EventController::class, 'index'])->name('page.events');
Route::get('event/{id}', [EventController::class, 'show'])->name('page.event.detail');
Route::get('training', [ContentController::class, 'training'])->name('page.training');
Route::get('training/{type?}/{course?}/{session?}', [ContentController::class, 'course'])->name('page.training.course');
Route::get('eagles-network', [ContentController::class, 'eaglesnetwork'])->name('page.eaglesnetwork');
Route::get('plans', [ContentController::class, 'plans'])->name('page.plans');

Route::post('auth/attempt', [AuthController::class, 'attempt'])->middleware('throttle:3,1')->name('attempt');
Route::get('auth/token/{token}', [AuthController::class, 'login'])->name('login.user');

Route::get('subscribe/{plan}', [PurchaseController::class, 'subscribe'])->name('subscribe');
Route::get('purchase/{price_id}', [PurchaseController::class, 'singlePurchase'])->name('page.landing.payment');
Route::get('welcome-to-the-course', [ContentController::class, 'SingleSuccess'])->name('page.SingleSuccess');
Route::get('welcome-to-the-mentorship', [ContentController::class, 'SubscribeSuccess'])->name('page.SubscribeSuccess');
Route::get('payment-cancelled', [ContentController::class, 'cancel'])->name('page.cancel');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Account routes - authentication handled in controller
Route::get('account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::put('account/profile', [App\Http\Controllers\AccountController::class, 'updateProfile'])->name('account.profile.update');
Route::post('account/subscription/{id}/cancel', [App\Http\Controllers\AccountController::class, 'cancelSubscription'])->name('account.subscription.cancel');
Route::post('account/subscription/{id}/resume', [App\Http\Controllers\AccountController::class, 'resumeSubscription'])->name('account.subscription.resume');
Route::get('account/invoices', [App\Http\Controllers\AccountController::class, 'getInvoices'])->name('account.invoices');
Route::get('account/invoice/{id}/download', [App\Http\Controllers\AccountController::class, 'downloadInvoice'])->name('account.invoice.download');

Route::get('discerning-spirits-school', [ContentController::class, 'schoolLanding'])->name('page.landing.school');



// This is for the import of data
// Route::get('csv', function () {
//     $insert = new JunkController;

//     foreach($insert->courses() as $course)
//     {

//         $insert->read($course);
//     }
//     return view('insert',['courses'=> $insert->courses()]);
// });
// Route::post('csv', [JunkController::class, 'read'])->name('csv.upload');
