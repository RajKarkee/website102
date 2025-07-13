<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Services Routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/payroll-management', [ServiceController::class, 'payrollManagement'])->name('services.payroll-management');
Route::get('/services/accounts-receivable', [ServiceController::class, 'accountsReceivable'])->name('services.accounts-receivable');
Route::get('/services/accounts-payable', [ServiceController::class, 'accountsPayable'])->name('services.accounts-payable');
Route::get('/services/credit-control', [ServiceController::class, 'creditControl'])->name('services.credit-control');
Route::get('/services/payroll-data-entry', [ServiceController::class, 'payrollDataEntry'])->name('services.payroll-data-entry');
Route::get('/services/gst-filing', [ServiceController::class, 'gstFiling'])->name('services.gst-filing');
Route::get('/services/paye-services', [ServiceController::class, 'payeServices'])->name('services.paye-services');
Route::get('/services/income-tax-returns', [ServiceController::class, 'incomeTaxReturns'])->name('services.income-tax-returns');
Route::get('/services/xero-training', [ServiceController::class, 'xeroTraining'])->name('services.xero-training');

// Other Pages
Route::get('/industries', [IndustryController::class, 'index'])->name('industries');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
