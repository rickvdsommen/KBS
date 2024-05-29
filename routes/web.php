<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DegreeController;


Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::post('/skills', [SkillController::class, 'store'])->name('skill.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skill.destroy');
    Route::post('/courses', [CourseController::class, 'store'])->name('course.store');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::post('/degrees', [DegreeController::class, 'store'])->name('degree.store');
    Route::delete('/degrees/{degree}', [DegreeController::class, 'destroy'])->name('degree.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('/projects', ProjectController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/categories', CategorieController::class);

    //Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    //Route::get('/categories/{category}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    //Route::put('/categories/{category}', [CategorieController::class, 'update'])->name('categories.update');
   // Route::delete('/categories/{category}', [CategorieController::class, 'destroy'])->name('categories.destroy');

});


require __DIR__.'/auth.php';
