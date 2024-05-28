<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;


Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/projects', function () {
//     return view('projects');
// })->middleware(['auth', 'verified'])->name('projects');

Route::get('/team', function () {
    return view('team');
})->middleware(['auth', 'verified'])->name('team');

Route::get('/agenda', function () {
    return view('agenda');
})->middleware(['auth', 'verified'])->name('agenda');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::prefix('admin')->group(function () {
//     Route::prefix('user')->group(function () {
// Route::post('/usersd', [UserController::class, 'getSignedUrl'])->name('users.invite');
//     });
// });

//dd test routes
// Route::get('/project', [ProjectController::class, 'projects'])->name('project');
// Route::get('/users', [UserController::class, 'users'])->name('users');
// Route::get('/categories', [CategorieController::class, 'Categories'])->name('Categories');
// Route::get('/tag', [TagController::class, 'tags'])->name('tags');


Route::middleware('auth')->group(function () {
    Route::resource('/projects', ProjectController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/category', CategorieController::class);



});


require __DIR__.'/auth.php';
