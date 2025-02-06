<?php

use App\Http\Controllers\ContentApprovalController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // JobOrderController
    Route::get('/joborder', [JobOrderController::class, 'index'])->name('joborder');
    Route::get('/joborder/create', [JobOrderController::class, 'create'])->name('joborder.create');
    Route::post('/joborder/store', [JobOrderController::class, 'store'])->name('joborder.store');
    Route::get('/joborder/show/{id}', [JobOrderController::class, 'show'])->name('joborder.show');
    Route::get('/joborder/edit/{id}', [JobOrderController::class, 'edit'])->name('joborder.edit');
    Route::put('/joborder/update/{id}', [JobOrderController::class, 'update'])->name('joborder.update');
});

Route::get('/approve', [ContentApprovalController::class, 'index'])->name('approve');


require __DIR__ . '/auth.php';
