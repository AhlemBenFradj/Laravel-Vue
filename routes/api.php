<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students', [StudentController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index']);

Route::get('/classes', [ClassesController::class, 'index']);
Route::get('/sections', [SectionController::class, 'index']);

Route::delete('/student/delete/{student}', [StudentController::class, 'destroy']); // Added a leading slash
Route::delete('/students/massDestroy/{students}', [StudentController::class, 'massDestroy']); // Added a leading slash

Route::get('/students/export/{students}', [StudentController::class, 'export']);

Route::post('/task/store', [TaskController::class, 'store']); // Added a leading slash and corrected the endpoint
Route::put('/task/{id}', [TaskController::class, 'update']); // Added a leading slash and corrected the endpoint
Route::delete('/task/{id}', [TaskController::class, 'destroy']); // Added a leading slash and corrected the endpoint

Route::get('/task/list', [TaskController::class, 'viewList'])->name('api.task.list'); // Corrected the endpoint and route name
