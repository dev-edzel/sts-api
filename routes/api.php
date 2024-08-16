<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    FaqsController,
    SubCategoryController,
    MerchantController,
    TicketController
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'merchants/trashed'], function () {
    Route::get('', [MerchantController::class, 'trashed']);
    Route::get('/restore/{id}', [MerchantController::class, 'restore']);
});
Route::resource('merchants', MerchantController::class);

Route::group(['prefix' => 'categories/trashed'], function () {
    Route::get('', [CategoryController::class, 'trashed']);
    Route::get('/restore/{id}', [CategoryController::class, 'restore']);
});
Route::resource('categories', CategoryController::class);
Route::resource('sub-categories', SubCategoryController::class);

Route::resource('tickets', TicketController::class);
// Route::post('send-otp', [TicketController::class, 'otp']);
Route::post('verify-otp', [TicketController::class, 'verifyOtp']);

Route::get('ticket-status', [TicketController::class, 'checkStatus']);

Route::resource('faqs', FaqsController::class);
