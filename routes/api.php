<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/student', [StudentController::class, 'index']); // GET request for listing students
Route::post('/student', [StudentController::class, 'store']); // POST request for creating a student
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::put('/student/{id}', [StudentController::class, 'update']); // Update a student
Route::delete('/student/{id}', [StudentController::class, 'destroy']); // Delete a student