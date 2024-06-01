<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/create',[UserController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::get('/dashboard',[UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('user/entry')->middleware(['auth', 'verified'])->controller(App\Http\Controllers\EntryController::class)->group(function () {
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('show/{id}', 'show')->name('entry.show')->where('id', '[0-9]+');
    Route::get('search', 'search')->name('entry.search');
    Route::get('create', 'create')->name('entry.create');
    Route::post('store', 'store')->name('entry.store');
    Route::get('edit/{id}', 'edit')->name('entry.edit')->where('id', '[0-9]+');
    Route::post('update/{id}', 'update')->name('entry.update')->where('id', '[0-9]+');
    Route::get('destroy/{id}', 'destroy')->name('entry.destroy')->where('id', '[0-9]+');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
