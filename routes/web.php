<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ObatalkesController;
use App\Http\Controllers\SignapolicyController;
use App\Http\Controllers\PrescriptionController;

Route::get('/', [PrescriptionController::class, 'index']);
Route::get('/obatalkes', [ObatalkesController::class, 'index'])->name('obat_alkes');
Route::get('/signapolicy', [SignapolicyController::class, 'index'])->name('signa_policy');
Route::get('/prescription', [PrescriptionController::class, 'index'])->name('prescriptions');

Route::get('modal-obatalkes', [ObatalkesController::class, 'modalObatalkes'])->name('modal_obatalkes');

Route::post('submit-resep', [PrescriptionController::class, 'submitResep'])->name('submit_resep');
Route::get('pdf-resep/{id}', [PrescriptionController::class, 'pdfResep'])->name('pdf_resep');
