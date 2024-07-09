<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/students', [StudentController::class, 'index'])->name('students')->middleware('verified');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::post('/create/product', [StudentController::class, 'create'])->name('create.student');

Route::post('/update/student', [StudentController::class, 'update'])->middleware('verified')->name('update.student');

Route::get('/clients', function (Request $request) {
    return view('clients',[
        'clients' => $request->user()->clients
    ]);
})->middleware(['auth', 'verified', 'role:admin'])->name('clients');

Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::delete('/students/{id}', [StudentController::class, 'delete'])->name('delete');

// Route::get('/product', function () {
//     return view('product');
// })->middleware(['auth', 'verified'])->name('product');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/manage/{user}', [PermissionController::class, 'show'])->name('manage');
Route::get('/manage-users', [PermissionController::class, 'index'])->name('manage-users')->middleware(['auth', 'verified', 'role:admin']);
Route::post('/manage/{user}', [PermissionController::class, 'update'])->name('manage.permissions.update');


require __DIR__.'/auth.php';
