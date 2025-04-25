<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Offers\OfferListController;
use App\Http\Controllers\Offers\OfferCreateController;
use App\Http\Controllers\Offers\OfferShowController;
use App\Http\Controllers\Offers\OfferEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('marketplace');
})->middleware(['auth', 'verified'])->name('marketplace');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Offers
Route::get('/', [OfferListController::class, 'marketplace'])
->middleware(['auth', 'verified'])->name('marketplace');

Route::get('/offers/list', [OfferListController::class, 'display'])
->middleware(['auth', 'verified'])->name('offers.list');

Route::get('/offers/create', [OfferCreateController::class, 'create'])
->middleware(['auth', 'verified'])->name('offers.create');

Route::post('/offers/store', [OfferCreateController::class, 'store'])
->middleware(['auth', 'verified'])->name('offers.store');

Route::get('/offers/show/{offerId}', [OfferShowController::class, 'display'])
->middleware(['auth', 'verified'])->name('offers.show');

Route::get('/offers/edit/{offer}', [OfferEditController::class, 'edit'])
->middleware(['auth', 'verified'])->name('offers.edit');

Route::put('/offers/{offer}', [OfferEditController::class, 'update'])
->middleware(['auth', 'verified'])->name('offers.update');


// VUE.JS endpoints
Route::get('/api/offer-form-data', function () {
    return response()->json([
        'currencies' => \App\Models\Currency::all(),
        'categories' => \App\Models\Category::all(),
    ]);
});