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
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LogoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CtaController as AdminCtaController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\PositionController as AdminPositionController;
use App\Http\Controllers\Admin\MiddleController as AdminMiddleController;
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
Route::get('/about', [Front1Controller::class, 'aboutPage'])->name('about');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/resources', [ResourceController::class, 'index'])->name('resources');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Logo Helper Test Route (remove in production)
Route::get('/logo-test', function () {
    return view('logo-test');
})->name('logo.test');


Route::get('/admin', function () {
    return view('admin.layout.dashboard');
})->name('admin.dashboard');


Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes (outside auth middleware)
    Route::prefix('login')->name('login.')->group(function () {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('form');
        Route::post('/', [LoginController::class, 'login'])->name('submit');
    });
Route::prefix('color')->name('color.')->group(function () {
    Route::match(['get', 'post'],   '/', [FrontController::class, 'colorIndex'])->name('index');
    Route::delete('/delete/{id}', [FrontController::class, 'colorDelete'])->name('destroy');
});
Route::prefix('middle')->name('middle.')->group(function(){
Route::get('/',[AdminMiddleController::class, 'index'])->name('index');
Route::match(['get','post'], '/add', [AdminMiddleController::class, 'create'])->name('create');
Route::match(['get','post'], '/addPoint/{id}', [AdminMiddleController::class, 'addPoint'])->name('addPoint');
Route::delete('/delete/{id}', [AdminMiddleController::class, 'destroy'])->name('destroy');
Route::match(['get','post'], '/edit/{id}', [AdminMiddleController::class, 'edit'])->name('edit');
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

        // // About routes
        // Route::prefix('about')->name('about.')->group(function () {
        //     Route::get('/', [FrontController::class, 'about'])->name('index');
        //     Route::match(['get', 'post'], '/add', [FrontController::class, 'aboutAdd'])->name('add');
        //     Route::match(['get', 'post'], '/edit/{id}', [FrontController::class, 'aboutEdit'])->name('edit');
        //     Route::delete('/delete/{id}', [FrontController::class, 'aboutDelete'])->name('delete');
        //     Route::match(['get', 'post'], '/addPoint/{id}', [FrontController::class, 'aboutAddPoint'])->name('addPoint');

        // });
        Route::prefix('about')->name('about.')->group(function () {
            Route::get('/', [FrontController::class, 'about'])->name('index');
            Route::match(['get', 'post'], '/add', [FrontController::class, 'aboutAdd'])->name('add');
            Route::match(['get', 'post'], '/edit/{id}', [FrontController::class, 'aboutEdit'])->name('edit');
            Route::put('/update/{id}', [FrontController::class, 'aboutUpdate'])->name('update'); // ✅ Here
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

        // Testimonials routes
        Route::prefix('testimonials')->name('testimonials.')->group(function () {
            Route::get('/', [TestimonialController::class, 'adminIndex'])->name('index');
            Route::post('/', [TestimonialController::class, 'store'])->name('store');
            Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('edit');
            Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('update');
            Route::get('/status/{testimonial}', [TestimonialController::class, 'updateStatus'])->name('status');
            Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy');
        });

        // FAQ routes
        Route::prefix('faq')->name('faq.')->group(function () {
            Route::get('/', [FaqController::class, 'index'])->name('index');
            Route::post('/', [FaqController::class, 'store'])->name('store');
            Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
            Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
            Route::get('/status/{faq}', [FaqController::class, 'updateStatus'])->name('status');
        });

        // Middle section routes
        // Route::prefix('middle')->name('middle.')->group(function () {
        //     Route::get('/', [FrontController::class, 'middleIndex'])->name('index');
        //     Route::get('/create', [FrontController::class, 'middleCreate'])->name('create');
        //     Route::post('/', [FrontController::class, 'middleStore'])->name('store');
        //     Route::get('/{id}/edit', [FrontController::class, 'middleEdit'])->name('edit');
        //     Route::put('/{id}', [FrontController::class, 'middleUpdate'])->name('update');
        //     Route::delete('/{id}', [FrontController::class, 'middleDestroy'])->name('destroy');
        // });

        // Partner routes
        Route::prefix('partner')->name('partner.')->group(function () {
            Route::get('/', [FrontController::class, 'partnerIndex'])->name('index');
            Route::get('/index', [FrontController::class, 'partnerIndex'])->name('index.alt');
            Route::post('/store', [FrontController::class, 'partnerStore'])->name('store');
            Route::post('/', [FrontController::class, 'partnerStore'])->name('store.alt');
        });
    });
});

Route::post('/admin/logout', function () {
    Auth::logout();
    return redirect('/admin/login')->with('success', 'Logged out successfully!');
})->name('admin.logout');

Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

// Logo Management Routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('logo', LogoController::class)->names([
        'index' => 'admin.logo.index',
        'create' => 'admin.logo.create',
        'store' => 'admin.logo.store',
        'show' => 'admin.logo.show',
        'edit' => 'admin.logo.edit',
        'update' => 'admin.logo.update',
        'destroy' => 'admin.logo.destroy',
    ]);
    Route::patch('logo/{logo}/activate', [LogoController::class, 'activate'])->name('admin.logo.activate');
});
