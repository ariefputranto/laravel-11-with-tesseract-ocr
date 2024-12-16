<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TesseractController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/delete', [UploadController::class, 'delete'])->name('upload.delete');

Route::post('/tesseract/parse', [TesseractController::class, 'parse'])->name('tesseract.parse');
