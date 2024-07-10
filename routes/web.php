<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\MonitorsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

//users only
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//users
Route::middleware(['auth', 'verified'])->group( function (){
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/action-history', [MonitorsController::class, 'index'])->name('action-history');

    Route::get('/dashboard', function (Request $request) {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    

});

//admin and teacher
Route::middleware(['auth', 'verified', 'role:admin|teacher'])->group( function() {
    Route::post('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/update', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{id}', [StudentController::class, 'delete'])->name('student.delete');
});

//admin
Route::middleware('auth', 'verified', 'role:admin')->group(function (){

    Route::get('/manage/{user}', [PermissionController::class, 'show'])->name('manage');
    Route::get('/manage-users', [PermissionController::class, 'index'])->name('manage-users');
    Route::post('/manage/{user}', [PermissionController::class, 'update'])->name('manage.permissions.update');
    
    Route::get('/clients', function (Request $request) {
        return view('clients',[
            'clients' => $request->user()->clients
        ]);
    })->middleware(['auth', 'verified', 'role:admin'])->name('clients');
    
});

require __DIR__.'/auth.php';
