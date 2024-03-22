<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('edit/{id}', [HomeController::class, 'edit'])->name('edit');
    Route::get('profile-update/{id}', [HomeController::class, 'profileUpdate'])->name('profile-update');
    Route::get('/', [HomeController::class, 'allNote']);

    Route::group(['prefix' => 'note', 'as' => 'note.'], function () {
        Route::get('list', [NoteController::class, 'list'])->name('list');
        Route::get('add', [NoteController::class, 'add'])->name('add');
        Route::post('store', [NoteController::class, 'store'])->name('store');
        Route::get('view/{id}', [NoteController::class, 'view'])->name('view');
        Route::get('edit/{id}', [NoteController::class, 'edit'])->name('edit');
        Route::get('delete/{id}', [NoteController::class, 'delete'])->name('delete');
        Route::get('search', [NoteController::class, 'search'])->name('search');
    });
});


