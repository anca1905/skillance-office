<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\DocumentationController;

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
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/export-pdf', [ProjectController::class, 'exportPdf'])->name('projects.export-pdf');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');

    Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::post('/finance/store', [FinanceController::class, 'store'])->name('finance.store');

    Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda.store');
    Route::post('/agenda/{id}/complete', [AgendaController::class, 'complete'])->name('agenda.complete');
    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');

    // MODULE DOKUMENTASI
    Route::get('/project/{id}/docs', [DocumentationController::class, 'index'])->name('docs.index');
    Route::post('/project/{id}/docs', [DocumentationController::class, 'store'])->name('docs.store');
    Route::delete('/docs/{id}', [DocumentationController::class, 'destroy'])->name('docs.destroy');
    Route::get('/project/{id}/print', [DocumentationController::class, 'printPdf'])->name('docs.print');
    Route::post('/project/{id}/cover', [DocumentationController::class, 'uploadCover'])->name('docs.cover.upload');

    // MODULE INVOICE
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{id}/print', [InvoiceController::class, 'printPdf'])->name('invoices.print');
    Route::post('/invoices/{id}/paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.paid');
});
