<?php

use App\Http\Controllers\AdminSupervisorRequestController;
use App\Http\Controllers\ClientApprovalController;
use App\Http\Controllers\ClientHistoryController;
use App\Http\Controllers\ClientRenewalController;
use App\Http\Controllers\ContentApprovalController;
use App\Http\Controllers\ContentHistoryController;
use App\Http\Controllers\ContentRevisionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraphicApprovalController;
use App\Http\Controllers\GraphicHistoryController;
use App\Http\Controllers\GraphicRevisionController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\JobOrderTrackerController;
use App\Http\Controllers\OperationApprovalController;
use App\Http\Controllers\OperationHistoryController;
use App\Http\Controllers\OperationRenewalController;
use App\Http\Controllers\OperationRevisionController;
use App\Http\Controllers\OperationTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestFormController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SupervisorApprovalController;
use App\Http\Controllers\SupervisorDirectJobOrderController;
use App\Http\Controllers\SupervisorHistoryController;
use App\Http\Controllers\SupervisorJobOrderController;
use App\Http\Controllers\SupervisorRenewalController;
use App\Http\Controllers\SupervisorRevisionController;
use App\Http\Controllers\SupervisorTaskController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth/login');
    });
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
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
Route::get('/content/create/{id}', [ContentApprovalController::class, 'create'])->name('content.create');
Route::put('/content/store/{id}', [ContentApprovalController::class, 'store'])->name('content.store');
Route::get('/content/edit/{id}', [ContentApprovalController::class, 'edit'])->name('content.edit');
Route::put('/content/update/{id}', [ContentApprovalController::class, 'update'])->name('content.update');

Route::get('/graphic', [GraphicApprovalController::class, 'index'])->name('graphic.approve');
Route::get('/graphic/show/{id}', [GraphicApprovalController::class, 'show'])->name('graphic.show');
Route::get('/graphic/create/{id}', [GraphicApprovalController::class, 'create'])->name('graphic.create');
Route::put('/graphic/store/{id}', [GraphicApprovalController::class, 'store'])->name('graphic.store');
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
Route::put('/client/renew/{id}', [ClientApprovalController::class, 'renew'])->name('client.renew');

Route::get('/supervisor/approve', [SupervisorApprovalController::class, 'index'])->name('supervisor.approve');
Route::get('/supervisor/approve/show/{id}', [SupervisorApprovalController::class, 'show'])->name('supervisor.show');
Route::get('/supervisor/approve/edit/{id}', [SupervisorApprovalController::class, 'edit'])->name('supervisor.edit');
Route::put('/supervisor/approve/update/{id}', [SupervisorApprovalController::class, 'update'])->name('supervisor.update');
Route::get('/supervisor/approve/declineForm/{id}', [SupervisorApprovalController::class, 'declineForm'])->name('supervisor.declineForm');
Route::put('/supervisor/approve/decline/{id}', [SupervisorApprovalController::class, 'decline'])->name('supervisor.decline');

Route::get('/content/revisions/', [ContentRevisionController::class, 'index'])->name('content.revisions');
Route::get('/content/revisions/edit/{id}', [ContentRevisionController::class, 'edit']);
Route::put('/content/revisions/update/{id}', [ContentRevisionController::class, 'update']);

Route::get('/graphic/revisions', [GraphicRevisionController::class, 'index'])->name('graphic.revisions');
Route::get('/graphic/revisions/edit/{id}', [GraphicRevisionController::class, 'edit']);
Route::put('/graphic/revisions/update/{id}', [GraphicRevisionController::class, 'update']);

Route::get('/client/history', [ClientHistoryController::class, 'index'])->name('client.history');
Route::get('/client/history/show/{id}', [ClientHistoryController::class, 'show'])->name('client.history.show');
Route::get('/client/history/download/{id}', [ClientHistoryController::class, 'downloadPDF'])->name('client.history.download');

Route::get('/content/history', [ContentHistoryController::class, 'index'])->name('content.history');
Route::get('/content/history/show/{id}', [ContentHistoryController::class, 'show'])->name('content.history.show');
Route::get('/content/history/download/{id}', [ContentHistoryController::class, 'downloadPDF'])->name('content.history.download');

Route::get('/graphic/history', [GraphicHistoryController::class, 'index'])->name('graphic.history');
Route::get('/graphic/history/show/{id}', [GraphicHistoryController::class, 'show'])->name('graphic.history.show');
Route::get('/graphic/history/download/{id}', [GraphicHistoryController::class, 'downloadPDF'])->name('graphic.history.download');

Route::get('/operation/history', [OperationHistoryController::class, 'index'])->name('operation.history');
Route::get('/operation/history/show/{id}', [OperationHistoryController::class, 'show'])->name('operation.history.show');
Route::get('/operation/history/download/{id}', [OperationHistoryController::class, 'downloadPDF'])->name('operation.history.download');

Route::get('/supervisor/history', [SupervisorHistoryController::class, 'index'])->name('supervisor.history');
Route::get('/supervisor/history/show/{id}', [SupervisorHistoryController::class, 'show'])->name('supervisor.history.show');
Route::get('/supervisor/history/download/{id}', [SupervisorHistoryController::class, 'downloadPDF'])->name('supervisor.history.download');

Route::get('/client/renewal', [ClientRenewalController::class, 'index'])->name('client.renewal');
Route::post('/client/update/{id}', [ClientRenewalController::class, 'update'])->name('client.update');

Route::get('/operation/renewal', [OperationRenewalController::class, 'index'])->name('operation.renewal');
Route::post('/operation/update/{id}', [OperationRenewalController::class, 'update'])->name('operation.update');

Route::get('/supervisor/renewal', [SupervisorRenewalController::class, 'index'])->name('supervisor.renewal');
Route::post('/supervisor/update/{id}', [SupervisorRenewalController::class, 'update'])->name('supervisor.update');

Route::get('/supervisor/joborder', [SupervisorJobOrderController::class, 'index'])->name('supervisor.joborder');
Route::get('/supervisor/joborder/create', [SupervisorJobOrderController::class, 'create'])->name('supervisor.create');
Route::post('/supervisor/joborder/store', [SupervisorJobOrderController::class, 'store'])->name('supervisor.store');
Route::get('/supervisor/joborder/show/{id}', [SupervisorJobOrderController::class, 'show'])->name('supervisor.show');
Route::get('/supervisor/joborder/edit/{id}', [SupervisorJobOrderController::class, 'edit'])->name('supervisor.edit');
Route::put('/supervisor/joborder/update/{id}', [SupervisorJobOrderController::class, 'update'])->name('supervisor.update');

Route::get('/operation/requests', [AdminSupervisorRequestController::class, 'index'])->name('operation.request');
Route::get('/operation/request/show/{id}', [AdminSupervisorRequestController::class, 'show'])->name('operation.show');
Route::get('/operation/request/create/{id}', [AdminSupervisorRequestController::class, 'create'])->name('operation.create');
Route::post('/operation/request/store', [AdminSupervisorRequestController::class, 'store'])->name('operation.store');

Route::get('/supervisor/directjob', [SupervisorDirectJobOrderController::class, 'index'])->name('supervisor.directjob');
Route::get('/supervisor/directjob/create', [SupervisorDirectJobOrderController::class, 'create'])->name('supervisor.directjob.create');
Route::post('/supervisor/directjob/store', [SupervisorDirectJobOrderController::class, 'store'])->name('supervisor.directjob.create');
Route::get('/supervisor/directjob/show/{id}', [SupervisorDirectJobOrderController::class, 'show'])->name('supervisor.directjob.show');
Route::get('/supervisor/directjob/edit/{id}', [SupervisorDirectJobOrderController::class, 'edit'])->name('supervisor.directjob.edit');
Route::put('/supervisor/directjob/update/{id}', [SupervisorDirectJobOrderController::class, 'update'])->name('supervisor.directjob.update');


//Create "My Tasks" tab for Admin DONE
Route::get('/operation/task', [OperationTaskController::class, 'index'])->name('operation.task');
Route::get('/operation/task/show/{id}', [OperationTaskController::class, 'show'])->name('operation.show');
Route::get('/operation/task/create/{id}', [OperationTaskController::class, 'create'])->name('operation.create');
Route::put('/operation/task/store/{id}', [OperationTaskController::class, 'store'])->name('operation.store');
Route::get('/operation/task/edit/{id}', [OperationTaskController::class, 'edit'])->name('operation.edit');
Route::put('/operation/task/update/{id}', [OperationTaskController::class, 'update'])->name('operation.update');

//Create "My Revisions" tab for Admin DONE
Route::get('/operation/revision', [OperationRevisionController::class, 'index'])->name('operation.revision');
Route::get('/operation/revision/edit/{id}', [OperationRevisionController::class, 'edit'])->name('operation.edit');
Route::put('/operation/revision/update/{id}', [OperationRevisionController::class, 'update'])->name('operation.update');

//Create "My Task" tab for Supervisor DONE
Route::get('/supervisor/task', [SupervisorTaskController::class, 'index'])->name('supervisor.task');
Route::get('/supervisor/task/show/{id}', [SupervisorTaskController::class, 'show'])->name('supervisor.show');
Route::get('/supervisor/task/create/{id}', [SupervisorTaskController::class, 'create'])->name('supervisor.create');
Route::put('/supervisor/task/store/{id}', [SupervisorTaskController::class, 'store'])->name('supervisor.store');
Route::get('/supervisor/task/edit/{id}', [SupervisorTaskController::class, 'edit'])->name('supervisor.edit');
Route::put('/supervisor/task/update/{id}', [SupervisorTaskController::class, 'update'])->name('supervisor.update');

//Create "My Revisions" tab for Supervisor  DONE
Route::get('/supervisor/revision', [SupervisorRevisionController::class, 'index'])->name('supervisor.revision');
Route::get('/supervisor/revision/edit/{id}', [SupervisorRevisionController::class, 'edit'])->name('supervisor.edit');
Route::put('/supervisor/revision/update/{id}', [SupervisorRevisionController::class, 'update'])->name('supervisor.update');

Route::get('/revision', [RevisionController::class, 'index'])->name('revision');
Route::get('/revision/show/{id}', [RevisionController::class, 'show'])->name('revision.show');
Route::get('/revision/edit/{id}', [RevisionController::class, 'edit'])->name('revision.edit');
Route::put('/revision/update/{id}', [RevisionController::class, 'update'])->name('revision.update');


Route::resource('/track', JobOrderTrackerController::class);

Route::put('/signature/store', [SignatureController::class, 'store'])->name('signature.store');

Route::get('requestForm/create', [RequestFormController::class, 'create'])->name('requestForm');
Route::get('requestForm/history', [RequestFormController::class, 'history']);
Route::post('requestForm/store', [RequestFormController::class, 'store']);




require __DIR__ . '/auth.php';
