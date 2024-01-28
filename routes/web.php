<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;

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
    return redirect('resume');
});

Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
Route::get('/resume/create', [ResumeController::class, 'create'])->name('resume.create');
Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');
Route::post('/generate-pdf', [ResumeController::class, 'generatePDF'])->name('generate.pdf');

Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.show');
