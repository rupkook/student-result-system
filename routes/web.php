<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

// Home route - login page
Route::get('/', function () {
    return view('auth.login');
})->name('home');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// Student Portal Routes (protected)
Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::get('/results', [StudentController::class, 'results'])->name('results');
});

// Admin Panel Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/results', [AdminController::class, 'results'])->name('results');
    Route::post('/results/publish', [AdminController::class, 'publishResult'])->name('results.publish');
    // Admin student management routes
    Route::get('/students/add', [AdminController::class, 'showAddStudentForm'])->name('admin.students.add');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/students/search/{student_id}', [AdminController::class, 'searchStudent'])->name('admin.students.search');
    Route::post('/students/store', [AdminController::class, 'storeStudent'])->name('admin.students.store');
    Route::get('/students/{id}/edit', [AdminController::class, 'editStudent'])->name('admin.students.edit');
    Route::post('/students/{id}/update', [AdminController::class, 'updateStudent'])->name('admin.students.update');
    Route::post('/students/{id}/delete', [AdminController::class, 'deleteStudent'])->name('admin.students.delete');
});
