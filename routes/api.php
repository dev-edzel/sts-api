<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    FaqsController,
    SubCategoryController,
    MerchantController,
    StatusController,
    TicketController,
    UserController,
    UserInfoController
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
Route::resource('ticket-statuses', StatusController::class);

Route::post('verify-otp', [TicketController::class, 'verifyOtp']);

Route::post('ticket-status', [TicketController::class, 'checkStatus']);

Route::resource('faqs', FaqsController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('users', UserController::class);
Route::resource('user-info', UserInfoController::class);
