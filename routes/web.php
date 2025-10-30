<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\permissionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [ProfileController::class, 'show'])->name('user.profile');;
    Route::put('/user-profile/{usuario}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('user-profile/image', [ProfileController::class, 'imagen'])->name('profile.avatar');
	Route::put('user-profile/{usuario}/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::put('teacher-academic/{teacher}', [TeacherController::class, 'updateAcademicInformation'])->name('teacher.academic');
    Route::resources([
        'users' => userController::class,
        'roles' => roleController::class,
        'permissions'=> permissionController::class,
        'news' => NewsController::class,
        'teachers' => TeacherController::class
    ]);
        
});

require __DIR__.'/auth.php';
