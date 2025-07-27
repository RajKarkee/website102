<?php

use App\Http\Controllers\Front1Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CtaController as AdminCtaController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\PositionController as AdminPositionController;

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
Route::get('/industries', [Front1Controller::class, 'industryPage'])->name('industries');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/admin', function () {
    return view('admin.layout.dashboard');
})->name('admin.dashboard');


Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (outside auth middleware)
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('form');
        Route::post('/', [LoginController::class, 'login'])->name('submit');
    });

    // Authentication required routes
    Route::middleware(['auth'])->group(function () {
        // Resource routes
        Route::resource('cta', AdminCtaController::class);
        Route::resource('team', AdminTeamController::class);
        Route::resource('position', AdminPositionController::class);
        
        // Industry routes
        Route::prefix('industry')->name('industry.')->group(function () {
            Route::get('/', [FrontController::class, 'industry'])->name('index');
            Route::match(['get', 'post'], '/add', [FrontController::class, 'industryAdd'])->name('add');
            Route::match(['get', 'post'], '/edit/{id}', [FrontController::class, 'industryEdit'])->name('edit');
            Route::delete('/delete/{id}', [FrontController::class, 'industryDelete'])->name('delete');
        });

        // Service routes
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('/', [FrontController::class, 'service'])->name('index');
            Route::match(['get', 'post'], '/add', [FrontController::class, 'serviceAdd'])->name('add');
            Route::match(['get', 'post'], '/edit/{id}', [FrontController::class, 'serviceEdit'])->name('edit');
            Route::delete('/delete/{id}', [FrontController::class, 'serviceDelete'])->name('delete');
            Route::get('/details/{id}', [FrontController::class, 'serviceDetails'])->name('details');
        });

        // Jumbotron routes
        Route::prefix('jumbotron')->name('jumbotron.')->group(function () {
            Route::get('/', [FrontController::class, 'jumbotronIndex'])->name('index');
            Route::match(['get', 'post'], '/add', [FrontController::class, 'jumbotronAdd'])->name('add');
            Route::match(['get', 'patch'], '/edit/{id}', [FrontController::class, 'jumbotronEdit'])->name('edit');
            Route::delete('/delete/{id}', [FrontController::class, 'jumbotronDelete'])->name('delete');
            Route::post('/change/{id}', [FrontController::class, 'StatusChange'])->name('change');
        });

        // About routes
        Route::prefix('about')->name('about.')->group(function () {
            Route::get('/', [FrontController::class, 'about'])->name('index');
            Route::match(['get', 'post'], '/add', [FrontController::class, 'aboutAdd'])->name('add');
            Route::match(['get', 'post'], '/edit/{id}', [FrontController::class, 'aboutEdit'])->name('edit');
            Route::delete('/delete/{id}', [FrontController::class, 'aboutDelete'])->name('delete');
            Route::match(['get', 'post'], '/addPoint/{id}', [FrontController::class, 'aboutAddPoint'])->name('addPoint');
        });

        // Products routes
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [AdminController::class, 'productsIndex'])->name('index');
            Route::get('/create', [AdminController::class, 'productsCreate'])->name('create');
            Route::get('/categories', [AdminController::class, 'categoriesIndex'])->name('categories.index');
        });

        // Orders routes
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [AdminController::class, 'ordersIndex'])->name('index');
            Route::get('/pending', [AdminController::class, 'ordersPending'])->name('pending');
            Route::get('/completed', [AdminController::class, 'ordersCompleted'])->name('completed');
        });
        
        // Analytics route
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        
        // Reports routes
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/sales', [AdminController::class, 'salesReport'])->name('sales');
            Route::get('/users', [AdminController::class, 'usersReport'])->name('users');
            Route::get('/products', [AdminController::class, 'productsReport'])->name('products');
        });

        // Partner routes
        Route::prefix('partner')->name('partner.')->group(function () {
            Route::get('/', [FrontController::class, 'partnerIndex'])->name('index');
            Route::post('/store', [FrontController::class, 'partnerStore'])->name('store');
        });
    });
});

// Partner routes (these should also be under auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/partner/index', [FrontController::class, 'partnerIndex'])->name('admin.partner.index');
    Route::post('/admin/partner/store', [FrontController::class, 'partnerStore'])->name('admin.partner.store');
});



Route::post('/admin/logout', function () {
    Auth::logout();
    return redirect('/admin/login')->with('success', 'Logged out successfully!');
})->name('admin.logout');

Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');


Route::get('/admin/partner/index', [FrontController::class, 'partnerIndex'])->name('admin.partner.index');
Route::post('/admin/partner/store', [FrontController::class, 'partnerStore'])->name('admin.partner.store');



Route::prefix('admin')->group(function () {
    Route::get('testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
    Route::post('testimonials', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
    Route::put('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonials.update'); // ✅ Added
    Route::get('testimonials/status/{testimonial}', [TestimonialController::class, 'updateStatus'])->name('admin.testimonials.status');
    Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
});
