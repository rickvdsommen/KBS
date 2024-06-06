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
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DashboardController;


// Routes for getting a view from a page
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');


Route::get('/agenda', function () {
    return view('agenda');
})->middleware(['auth', 'verified'])->name('agenda');

// Routes for CRUD items
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

    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::post('/events', [AgendaController::class, 'store'])->name('event.store');
    Route::patch('/events/{event}', [AgendaController::class, 'update'])->name('event.update');
    Route::get('/events', [AgendaController::class, 'getEvents'])->name('events');

    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/{user}', [TeamController::class, 'show'])->name('team.show');

    Route::resource('/projects', ProjectController::class);

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
});

// Only accessible with admin role
Route::middleware(['role_or_permission:admin'])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/categories', CategorieController::class);
});

require __DIR__.'/auth.php';