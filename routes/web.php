<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['check-status', 'auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('invoices', InvoiceController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('products', ProductController::class);
    Route::resource('details', InvoiceDetailController::class);
    Route::resource('attchments', InvoiceAttachmentController::class);
    Route::resource('Archive', InvoiceArchiveController::class);

    //get routes
    Route::get('/section/{id}', [InvoiceController::class, 'getproducts']);

    Route::controller(InvoiceDetailController::class)->group(function () {
        Route::get('download/{invoice_number}/{file_name}', 'get_file');
        Route::get('View_file/{invoice_number}/{file_name}', 'open_file');
        Route::post('delete_file', 'destroy')->name('delete_file');
    });

    Route::post('/Status_Update/{id}', [InvoiceController::class, 'Status_Update'])->name('Status_Update');

    Route::get('Invoice_Paid', [InvoiceController::class, 'Invoice_Paid']);
    Route::get('Invoice_UnPaid', [InvoiceController::class, 'Invoice_UnPaid']);
    Route::get('Invoice_Partial', [InvoiceController::class, 'Invoice_Partial']);

    Route::get('Print_invoice/{id}', [InvoiceController::class, 'Print_invoice']);
    Route::get('export_invoices', [InvoiceController::class, 'export']);

    Route::get('invoices_report', [InvoiceReportController::class, 'index']);
    Route::post('Search_invoices', [InvoiceReportController::class, 'Search_invoices']);

    Route::get('customers_report', [CustomerReportController::class, 'index'])->name("customers_report");
    Route::post('Search_customers', [CustomerReportController::class, 'Search_customers']);

    // Route::get('MarkAsRead_all', 'InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');
    // Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');
    // Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
require __DIR__ . '/auth.php';

Route::get('/{page}', [AdminController::class, 'index']);
