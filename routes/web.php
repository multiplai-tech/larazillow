<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\RealtorListingAcceptOfferController;


use App\Http\Controllers\V1\Auth\IndexController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\LogoutController;

use App\Http\Controllers\V1\Listing\IndexController as ListingIndexController;
use App\Http\Controllers\V1\Listing\ShowController as ListingShowController;

use App\Http\Controllers\V1\ListingOffer\StoreController as ListingOfferStoreController;

use App\Http\Controllers\V1\Notification\IndexController as NotificationIndexController;
use App\Http\Controllers\V1\Notification\MarkAsReadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect('/listing');
});

Route::get('login', IndexController::class)->name('login');
Route::post('login', LoginController::class)->name('login.store');
Route::delete('logout', LogoutController::class)->name('logout');

Route::prefix('listing')
->name('listing.')
->group(function () {
    Route::get('/', ListingIndexController::class)->name('index');
	Route::get('/{listing}', ListingShowController::class)->name('show');

	Route::post('/{listing}/offer', ListingOfferStoreController::class)
		->name('offer.store')
		->middleware('auth');
});

Route::prefix('notification')
	->name('notification.')
	->group(function () {
		Route::get('/', NotificationIndexController::class)
			->middleware('auth')
			->name('index');
		
		Route::put('/{notification}/seen', MarkAsReadController::class)
			->middleware('auth')
			->name('seen');
	});

// Route::resource('notification', NotificationController::class)
//   ->middleware('auth')
//   ->only(['index']);


// Route::resource('listing.offer', ListingOfferController::class)
//   ->middleware('auth')
//   ->only(['store']);

// Route::resource('notification', NotificationController::class)
//   ->middleware('auth')
//   ->only(['index']);


// Route::put(
//   'notification/{notification}/seen',
//   NotificationSeenController::class
// )->middleware('auth')->name('notification.seen');

Route::get('/email/verify', function () {
  return inertia('Auth/VerifyEmail');
})
  ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect()->route('listing.index')
    ->with('success', 'Email was verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('user-account', UserAccountController::class)
  ->only(['create', 'store']);

Route::prefix('realtor')
  ->name('realtor.')
  ->middleware(['auth', 'verified'])
  ->group(function () {
    Route::name('listing.restore')
      ->put(
        'listing/{listing}/restore',
        [RealtorListingController::class, 'restore']
      )->withTrashed();
    Route::resource('listing', RealtorListingController::class)
      // ->only(['index', 'destroy', 'edit', 'update', 'create', 'store'])
      ->withTrashed();

    Route::name('offer.accept')
      ->put(
        'offer/{offer}/accept',
        RealtorListingAcceptOfferController::class
      );

    Route::resource('listing.image', RealtorListingImageController::class)
      ->only(['create', 'store', 'destroy']);
  });
