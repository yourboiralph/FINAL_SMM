<?php

use App\Http\Controllers\ClientApprovalController;
use App\Http\Controllers\ContentApprovalController;
use App\Http\Controllers\ContentRevisionController;
use App\Http\Controllers\GraphicApprovalController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\OperationApprovalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopApprovalController;
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

Route::get('/content', [ContentApprovalController::class, 'index'])->name('content.approve');
Route::get('/content/show/{id}', [ContentApprovalController::class, 'show'])->name('content.show');
Route::get('/content/edit/{id}', [ContentApprovalController::class, 'edit'])->name('content.edit');
Route::put('/content/update/{id}', [ContentApprovalController::class, 'update'])->name('content.update');

Route::get('/graphic', [GraphicApprovalController::class, 'index'])->name('graphic.approve');
Route::get('/graphic/show/{id}', [GraphicApprovalController::class, 'show'])->name('graphic.show');
Route::get('/graphic/edit/{id}', [GraphicApprovalController::class, 'edit'])->name('graphic.edit');
Route::put('/graphic/update/{id}', [GraphicApprovalController::class, 'update'])->name('graphic.update');

Route::get('/operation', [OperationApprovalController::class, 'index'])->name('operation.approve');
Route::get('/operation/show/{id}', [OperationApprovalController::class, 'show'])->name('operation.show');
Route::get('/operation/edit/{id}', [OperationApprovalController::class, 'edit'])->name('operation.edit');
Route::put('/operation/update/{id}', [OperationApprovalController::class, 'update'])->name('operation.update');
Route::get('/operation/decline/{id}', [OperationApprovalController::class, 'declineForm']);
Route::post('/operation/decline/{id}', [OperationApprovalController::class, 'decline']);

Route::get('/topmanager', [TopApprovalController::class, 'index'])->name('topmanager.approve');
Route::get('/topmanager/show/{id}', [TopApprovalController::class, 'show'])->name('topmanager.show');
Route::get('/topmanager/edit/{id}', [TopApprovalController::class, 'edit'])->name('topmanager.edit');
Route::put('/topmanager/update/{id}', [TopApprovalController::class, 'update'])->name('topmanager.update');
Route::get('/topmanager/decline/{id}', [TopApprovalController::class, 'declineForm']);
Route::post('/topmanager/decline/{id}', [TopApprovalController::class, 'decline']);

Route::get('/client', [ClientApprovalController::class, 'index'])->name('client.approve');
Route::get('/client/show/{id}', [ClientApprovalController::class, 'show'])->name('client.show');
Route::get('/client/edit/{id}', [ClientApprovalController::class, 'edit'])->name('client.edit');
Route::put('/client/update/{id}', [ClientApprovalController::class, 'update'])->name('client.update');
Route::get('/client/decline/{id}', [ClientApprovalController::class, 'declineForm']);
Route::post('/client/decline/{id}', [ClientApprovalController::class, 'decline']);

Route::get('/revisions', [ContentRevisionController::class, 'index']);

use App\Http\Controllers\SignatureController;

Route::get('/signature', function () {
    return view('signature');
});

Route::post('/signature/store', [SignatureController::class, 'store'])->name('signature.store');


require __DIR__ . '/auth.php';
