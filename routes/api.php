<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    TicketTypeController,
    TicketController
};

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'ticket-types/trashed'], function () {
    Route::get('', [TicketTypeController::class, 'trashed']);
    Route::get('/restore/{id}', [TicketTypeController::class, 'restore']);
});
Route::resource('ticket-types', TicketTypeController::class);

Route::group(['prefix' => 'categories/trashed'], function () {
    Route::get('', [CategoryController::class, 'trashed']);
    Route::get('/restore/{id}', [CategoryController::class, 'restore']);
});
Route::resource('categories', CategoryController::class);

Route::resource('tickets', TicketController::class);