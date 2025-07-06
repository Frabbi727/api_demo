<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return ['name' => 'Rabbi', 'mobile' => '012344567'];
});

Route::post('signup', [UserAuthController::class, 'signup']);
Route::post('login', [UserAuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/students', [StudentController::class, 'listOfStudents']);
    Route::post('add-student', [StudentController::class, 'addStudent']);
    Route::put('update-student/{id}', [StudentController::class, 'updateStudent']);
    Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);
});


/*Route::get('/students', [StudentController::class, 'listOfStudents']);
Route::post('add-student', [StudentController::class, 'addStudent']);
Route::put('update-student/{id}', [StudentController::class, 'updateStudent']);
Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);*/


Route::resource('member', MemberController::class);


