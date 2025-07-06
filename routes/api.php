<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return [ 'name'=>'Rabbi','mobile'=>'012344567' ];
});

Route::get('/students', [StudentController::class, 'listOfStudents']);
Route::post('add-student', [StudentController::class, 'addStudent']);
Route::put('update-student/{id}', [StudentController::class, 'updateStudent']);
