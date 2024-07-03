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
use App\Http\Middleware\DeactivatedCheck;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LocationController;

// Routes for getting a view from a page
Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Routes for CRUD items
Route::middleware('auth', DeactivatedCheck::class)->group(function () {
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
    Route::patch('/events', [AgendaController::class, 'patch'])->name('event.patch');
    Route::get('/events', [AgendaController::class, 'getEvents'])->name('events');
    Route::delete('/events/{id}', [AgendaController::class, 'destroy'])->name('event.destroy');

    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/team/{user}', [TeamController::class, 'show'])->name('team.show');

    Route::resource('/projects', ProjectController::class);

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::post('/availability/update', [DeviceController::class, 'updateAvailability'])->name('availability.update');
});

// Only accessible with admin role
Route::middleware(['role_or_permission:admin', 'auth', DeactivatedCheck::class])->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/categories', CategorieController::class);

    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
    Route::delete('/locations/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::post('/devices/link', [DeviceController::class, 'link'])->name('devices.link');
    Route::post('/devices/unlink', [DeviceController::class, 'unlink'])->name('devices.unlink');
    Route::patch('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
});
// In routes/web.php

Route::middleware('auth')->group(function () { // Removed 'deactivated'
     // Add this line

});

require __DIR__.'/auth.php';