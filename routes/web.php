<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Pos\DashboardController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\StockController;

Route::get('/', function () {
    return view('welcome');
});
 

Route::controller(DemoController::class)->group(function () {
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('cotact.page');
});


 // Admin All Route 
Route::prefix('owner')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/logout', 'destroy')->name('admin.logout');
        Route::get('/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/login','Index')->name('admin.login.form');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
        Route::post('/login/owner','LoginAdmin')->name('admin.login');
        Route::get('/dashboard','Dashboard')->name('admin.dashboard');
        Route::get('/register','RegisterAdmin')->name('admin.register.form');
        Route::post('/register/owner','StoreAdmin')->name('admin.register');
        
        // Route::group(['middleware'=>'admin'],function(){
        //     Route::get('/dashboard','Dashboard')->name('admin.dashboard');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function () {
            Route::get('/dashboard','Dashboard')->name('admin.dashboard');
        });
    });
    Route::controller(OutletController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function() {
            Route::get('/outlet/all','OutletAll')->name('admin.outlet.all');
            Route::get('/outlet/add','OutletAdd')->name('admin.outlet.add');
            Route::get('/outlet/add/first','OutletFirstAdd')->name('admin.outlet.first.add');
            Route::post('/outlet/store','OutletStore')->name('admin.outlet.store'); 
            Route::get('/outlet/edit/{id}','OutletEdit')->name('admin.outlet.edit');
            Route::get('/{id}/dashboard','OutletChoose')->name('admin.outlet.choose');
            Route::post('/outlet/update', 'OutletUpdate')->name('admin.outlet.update');
            // Route::get('/outlet/delete/{id}','OutletDelete')->name('admin.outlet.delete');
        });
    });
    Route::controller(EmployeeController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function () { 
            Route::get('/pengaturan/karyawan','EmployeeAll')->name('employee.all');
            Route::get('/pengaturan/karyawan/add','EmployeeAdd')->name('employee.add');
            Route::post('/pengaturan/karyawan/add/store','EmployeeStore')->name('employee.store');
            Route::get('/pengaturan/karyawan/delete/{id}','EmployeeDelete')->name('employee.delete');
            Route::get('/pengaturan/karyawan/edit/{id}','EmployeeEdit')->name('employee.edit');
            Route::post('/pengaturan/karyawan/update','EmployeeUpdate')->name('employee.update');
        });
    });

    Route::controller(SupplierController::class)->group(function () { 
        Route::group(['middleware' => 'admin'], function () {
            Route::get('/supplier/all', 'SupplierAll')->name('admin.supplier.all'); 
            Route::get('/supplier/add', 'SupplierAdd')->name('admin.supplier.add'); 
            Route::post('/supplier/store', 'SupplierStore')->name('admin.supplier.store');
            Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('admin.supplier.edit'); 
            Route::post('/supplier/update', 'SupplierUpdate')->name('admin.supplier.update');
            Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('admin.supplier.delete');
        });
    });

    Route::controller(CustomerController::class)->group(function(){
        Route::group(['middleware' => 'admin'], function () { 
            Route::get('/customer/all', 'CustomerAll')->name('admin.customer.all'); 
            Route::get('/customer/add', 'CustomerAdd')->name('admin.customer.add');
            Route::post('/customer/store', 'CustomerStore')->name('admin.customer.store');
            Route::get('/customer/edit/{id}', 'CustomerEdit')->name('admin.customer.edit');
            Route::post('/customer/update', 'CustomerUpdate')->name('admin.customer.update');
            Route::get('/customer/delete/{id}', 'CustomerDelete')->name('admin.customer.delete');
        });
    });

    Route::controller(UnitController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function () {  
            Route::get('/unit/all', 'UnitAll')->name('admin.unit.all'); 
            Route::get('/unit/add', 'UnitAdd')->name('admin.unit.add');
            Route::post('/unit/store', 'UnitStore')->name('admin.unit.store');
            Route::get('/unit/edit/{id}', 'UnitEdit')->name('admin.unit.edit');
            Route::post('/unit/update', 'UnitUpdate')->name('admin.unit.update');
            Route::get('/unit/delete/{id}', 'UnitDelete')->name('admin.unit.delete');
        });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function() {
            Route::get('/category/all', 'CategoryAll')->name('admin.category.all'); 
            Route::get('/category/add', 'CategoryAdd')->name('admin.category.add');
            Route::post('/category/store', 'CategoryStore')->name('admin.category.store');
            Route::get('/category/edit/{id}', 'CategoryEdit')->name('admin.category.edit');
            Route::post('/category/update', 'CategoryUpdate')->name('admin.category.update');
            Route::get('/category/delete/{id}', 'CategoryDelete')->name('admin.category.delete');
        });
    });

    Route::controller(ProductController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function() { 
            Route::get('/product/all', 'ProductAll')->name('admin.product.all'); 
            Route::get('/product/add', 'ProductAdd')->name('admin.product.add');
            Route::post('/product/store', 'ProductStore')->name('admin.product.store');
            Route::get('/product/edit/{id}', 'ProductEdit')->name('admin.product.edit');
            Route::post('/product/update', 'ProductUpdate')->name('admin.product.update');
            Route::get('/product/delete/{id}', 'ProductDelete')->name('admin.product.delete');
        });
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::group(['middleware' => 'admin'], function() { 
            Route::get('/purchase/all', 'PurchaseAll')->name('admin.purchase.all'); 
        Route::get('/purchase/add', 'PurchaseAdd')->name('admin.purchase.add');
        Route::post('/purchase/store', 'PurchaseStore')->name('admin.purchase.store');
        // Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('admin.purchase.delete');
        Route::get('/purchase/pending', 'PurchasePending')->name('admin.purchase.pending');
        Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('admin.purchase.approve');
        Route::get('/purchase/reject/{id}', 'PurchaseReject')->name('admin.purchase.reject');
        
        Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('admin.daily.purchase.report');
        Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('admin.daily.purchase.pdf');
        Route::get('/daily/purchase/print_pdf','PrintDailyPurchasePdf')->name('admin.print.daily.purchase.pdf');
        Route::get('/daily/purchase/export','ExportDailyPurchase')->name('admin.export.daily.purchase');
        });
        
    });

    Route::controller(InvoiceController::class)->group(function (){
        Route::group(['middleware' => 'admin'],function() {
            Route::get('/invoice/all', 'InvoiceAll')->name('admin.invoice.all'); 
            Route::get('/invoice/add', 'invoiceAdd')->name('admin.invoice.add');
            Route::post('/invoice/store', 'InvoiceStore')->name('admin.invoice.store');
        
            Route::get('/invoice/pending/list', 'PendingList')->name('admin.invoice.pending.list');
            // Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('admin.invoice.delete');
            Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('admin.invoice.approve');
            Route::get('/invoice/reject/{id}', 'InvoiceReject')->name('admin.invoice.reject');
            
            Route::post('/approval/store/{id}', 'ApprovalStore')->name('admin.approval.store');
            Route::post('/reject/store/{id}', 'RejectStore')->name('admin.reject.store');
            Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('admin.daily.invoice.report');
            Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('admin.daily.invoice.pdf');
            Route::get('/daily/invoice/print_pdf','PrintDailyInvoicePdf')->name('admin.print.daily.invoice.pdf');
            Route::get('/daily/invoices/export','ExportDailyInvoice')->name('admin.export.daily.invoice');
        });
    });

    Route::controller(StockController::class)->group(function () {
        Route::group(['middleware' => 'admin'],function() { 
            Route::get('/stock/report', 'StockReport')->name('admin.stock.report'); 
            Route::get('/stock/report/pdf', 'StockReportPdf')->name('admin.stock.report.pdf'); 
            Route::get('/stock/report/pdf/print','PrintStockReportPdf')->name('admin.print.stock.report.pdf');
            Route::get('/stock/report/export','ExportStock')->name('admin.export.stock.report');
        });
    });

});

Route::prefix('employee')->group(function () { 
    Route::controller(EmployeeController::class)->group(function() {
        Route::get('/login','Index')->name('employee.login.form');
        Route::get('/logout', 'destroy')->name('employee.logout');
        Route::post('/login/employee','LoginEmployee')->name('employee.login');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::group(['middleware' => 'employee'], function () {
            Route::get('/dashboard','Dashboard')->name('employee.dashboard');
        });
    });
    Route::controller(SupplierController::class)->group(function () {
        Route::group(['middleware' => 'employee'], function () {
            Route::get('/supplier/all', 'SupplierAll')->name('employee.supplier.all'); 
            Route::get('/supplier/add', 'SupplierAdd')->name('employee.supplier.add'); 
            Route::post('/supplier/store', 'SupplierStore')->name('employee.supplier.store');
            Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('employee.supplier.edit'); 
            Route::post('/supplier/update', 'SupplierUpdate')->name('employee.supplier.update');
            // Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
        });
    });
    Route::controller(CustomerController::class)->group(function(){
        Route::group(['middleware' => 'employee'], function () { 
            Route::get('/customer/all', 'CustomerAll')->name('employee.customer.all'); 
            Route::get('/customer/add', 'CustomerAdd')->name('employee.customer.add');
            Route::post('/customer/store', 'CustomerStore')->name('employee.customer.store');
            Route::get('/customer/edit/{id}', 'CustomerEdit')->name('employee.customer.edit');
            Route::post('/customer/update', 'CustomerUpdate')->name('employee.customer.update');
            // Route::get('/customer/delete/{id}', 'CustomerDelete')->name('employee.customer.delete');
        });
    });

    Route::controller(UnitController::class)->group(function () {
        Route::group(['middleware' => 'employee'], function () {  
            Route::get('/unit/all', 'UnitAll')->name('employee.unit.all'); 
            // Route::get('/unit/add', 'UnitAdd')->name('employee.unit.add');
            // Route::post('/unit/store', 'UnitStore')->name('employee.unit.store');
            Route::get('/unit/edit/{id}', 'UnitEdit')->name('employee.unit.edit');
            Route::post('/unit/update', 'UnitUpdate')->name('employee.unit.update');
            // Route::get('/unit/delete/{id}', 'UnitDelete')->name('employee.unit.delete');
        });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::group(['middleware' => 'employee'], function() {
            Route::get('/category/all', 'CategoryAll')->name('employee.category.all'); 
            // Route::get('/category/add', 'CategoryAdd')->name('category.add');
            // Route::post('/category/store', 'CategoryStore')->name('category.store');
            // Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
            // Route::post('/category/update', 'CategoryUpdate')->name('category.update');
            // Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
        });
    });

    Route::controller(ProductController::class)->group(function () {
        Route::group(['middleware' => 'employee'], function() {
            Route::get('/product/all', 'ProductAll')->name('employee.product.all'); 
        });
         
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::group(['middleware' => 'employee'],function() { 
            Route::get('/purchase/all', 'PurchaseAll')->name('employee.purchase.all'); 
        Route::get('/purchase/add', 'PurchaseAdd')->name('employee.purchase.add');
        Route::post('/purchase/store', 'PurchaseStore')->name('employee.purchase.store');
        // Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
        Route::get('/purchase/pending', 'PurchasePending')->name('employee.purchase.pending');
        // Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
        
        Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('employee.daily.purchase.report');
        Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('employee.daily.purchase.pdf');
        Route::get('/daily/purchase/print_pdf','PrintDailyPurchasePdf')->name('employee.print.daily.purchase.pdf');
        Route::get('/daily/purchase/export','ExportDailyPurchase')->name('employee.export.daily.purchase');
        });
    });

    

    // Route::controller()
    Route::controller(InvoiceController::class)->group(function (){
        Route::group(['middleware' => 'employee'],function() {
            Route::get('/invoice/all', 'InvoiceAll')->name('employee.invoice.all'); 
            Route::get('/invoice/add', 'invoiceAdd')->name('employee.invoice.add');
            Route::post('/invoice/store', 'InvoiceStore')->name('employee.invoice.store');
        
            Route::get('/invoice/pending/list', 'PendingList')->name('employee.invoice.pending.list');
            // Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('employee.invoice.delete');
            // Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('employee.invoice.approve');
            
            // Route::post('/approval/store/{id}', 'ApprovalStore')->name('employee.approval.store');
            Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('employee.daily.invoice.report');
            Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('employee.daily.invoice.pdf');
            Route::get('/daily/invoice/print_pdf','PrintDailyInvoicePdf')->name('employee.print.daily.invoice.pdf');
            Route::get('/daily/invoices/export','ExportDailyInvoice')->name('employee.export.daily.invoice');
        });
    });

    Route::controller(StockController::class)->group(function () {
        Route::group(['middleware' => 'employee'],function() { 
            Route::get('/stock/report', 'StockReport')->name('employee.stock.report'); 
            Route::get('/stock/report/pdf', 'StockReportPdf')->name('employee.stock.report.pdf'); 
            Route::get('/stock/report/pdf/print','PrintStockReportPdf')->name('employee.print.stock.report.pdf');
            Route::get('/stock/report/export','ExportStock')->name('employee.export.stock.report');
        });
    });
    
});





// Route::controller(CustomerController::class)->group(function(){
//     Route::group(['middleware' => 'admin'], function () { 
//         Route::get('/customer/all', 'CustomerAll')->name('customer.all'); 
//         Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
//         Route::post('/customer/store', 'CustomerStore')->name('customer.store');
//         Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
//         Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
//         Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');
//     });
//     Route::group(['middleware' => 'employee'], function () { 
//         Route::get('/customer/all', 'CustomerAll')->name('customer.all'); 
//         Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
//         Route::post('/customer/store', 'CustomerStore')->name('customer.store');
//         Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
//         Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
//         Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');
//     });
// });



// Route::controller(CategoryController::class)->group(function () {
//     Route::group(['middleware' => 'admin'], function() {
//         Route::get('/category/all', 'CategoryAll')->name('category.all'); 
//         Route::get('/category/add', 'CategoryAdd')->name('category.add');
//         Route::post('/category/store', 'CategoryStore')->name('category.store');
//         Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
//         Route::post('/category/update', 'CategoryUpdate')->name('category.update');
//         Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
//     });
// });





 // Supplier All Route 
// Route::controller(SupplierController::class)->group(function () {
//     Route::get('/supplier/all', 'SupplierAll')->name('supplier.all'); 
//     Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add'); 
//     Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
//     Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit'); 
//     Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
//     Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
// });


// Customer All Route 
// Route::controller(CustomerController::class)->group(function () {
//     Route::get('/customer/all', 'CustomerAll')->name('customer.all'); 
//     Route::get('/customer/add', 'CustomerAdd')->name('customer.add');
//     Route::post('/customer/store', 'CustomerStore')->name('customer.store');
//     Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit');
//     Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
//     Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');
     
// });


// Unit All Route 
// Route::controller(UnitController::class)->group(function () {
//     Route::get('/unit/all', 'UnitAll')->name('unit.all'); 
//     Route::get('/unit/add', 'UnitAdd')->name('unit.add');
//     Route::post('/unit/store', 'UnitStore')->name('unit.store');
//     Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
//     Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
//     Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');
     
// });


// Category All Route 
// Route::controller(CategoryController::class)->group(function () {
//     Route::get('/category/all', 'CategoryAll')->name('category.all'); 
//     Route::get('/category/add', 'CategoryAdd')->name('category.add');
//     Route::post('/category/store', 'CategoryStore')->name('category.store');
//     Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
//     Route::post('/category/update', 'CategoryUpdate')->name('category.update');
//     Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
     
// });


// Product All Route 
// Route::controller(ProductController::class)->group(function () {
//     Route::get('/product/all', 'ProductAll')->name('product.all'); 
//     Route::get('/product/add', 'ProductAdd')->name('product.add');
//     Route::post('/product/store', 'ProductStore')->name('product.store');
//     Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
//     Route::post('/product/update', 'ProductUpdate')->name('product.update');
//     Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');
     
// });


  
// Purchase All Route 
// Route::controller(PurchaseController::class)->group(function () {
//     Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all'); 
//     Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
//     Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
//     Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
//     Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
//     Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
    
//     Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('daily.purchase.report');
//     Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');
//     Route::get('/daily/purchase/print_pdf','PrintDailyPurchasePdf')->name('print.daily.purchase.pdf');
//     Route::get('/daily/purchase/export','ExportDailyPurchase')->name('export.daily.purchase');
// });


// Invoice All Route 
// Route::controller(InvoiceController::class)->group(function () {
//     Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all'); 
//     Route::get('/invoice/add', 'invoiceAdd')->name('invoice.add');
//     Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');

//     Route::get('/invoice/pending/list', 'PendingList')->name('invoice.pending.list');
//     Route::get('/invoice/delete/{id}', 'InvoiceDelete')->name('invoice.delete');
//     Route::get('/invoice/approve/{id}', 'InvoiceApprove')->name('invoice.approve');
    
//     Route::post('/approval/store/{id}', 'ApprovalStore')->name('approval.store');
//     Route::get('/daily/invoice/report', 'DailyInvoiceReport')->name('daily.invoice.report');
//     Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
//     Route::get('/daily/invoice/print_pdf','PrintDailyInvoicePdf')->name('print.daily.invoice.pdf');
//     Route::get('/daily/invoices/export','ExportDailyInvoice')->name('export.daily.invoice');
// });

// Route::controller(StockController::class)->group(function () {
//     Route::get('/stock/report', 'StockReport')->name('stock.report'); 
//     Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf'); 
// });







// Default All Route 
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'GetCategory')->name('get-category'); 
    Route::get('/get-product', 'GetProduct')->name('get-product'); 
    Route::get('/check-product', 'GetStock')->name('check-product-stock'); 
     
});


 


Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/contact', function () {
//     return view('contact');
// });