<?php

use App\Http\Controllers\CvController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Language switcher
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

// CV front page
Route::get('/', [CvController::class, 'index'])->name('cv.index');

// Downloads
Route::get('/download/pdf',  [DownloadController::class, 'pdf'])->name('download.pdf');
Route::get('/download/docx', [DownloadController::class, 'docx'])->name('download.docx');
