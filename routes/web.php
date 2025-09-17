<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BartenderController;
use App\Http\Controllers\OutgoingProductController;
use App\Http\Controllers\IncomingProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaitressController;
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('login',[UserController::class,'login'])->name('login');
Route::post('login',[UserController::class,'loginprocess'])->name('loginprocess');
Route::get('logout',[UserController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('users',[UserController::class,'users'])->name('users');
        Route::post('users',[UserController::class,'store'])->name('users.store');
        Route::put('users/{id}',[UserController::class,'update'])->name('users.update');
        Route::delete('users/{id}',[UserController::class,'delete'])->name('users.delete');
        Route::get('users/exportPDFAll',[UserController::class,'exportPDFAll'])->name('users.exportPDFAll');
        Route::get('users/exportExcel',[UserController::class,'exportExcel'])->name('users.exportExcel');


        Route::get('dashboard',[UserController::class,'index'])->name('home');
        Route::get('category',[CategoryController::class,'index'])->name('category.index');
        Route::post('category',[CategoryController::class,'store'])->name('category.store');
        Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('category/{category}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('category/exportPDFAll',[CategoryController::class,'exportPDFAll'])->name('category.exportPDFAll');
        Route::get('category/exportPDF/{id}',[CategoryController::class,'exportPDF'])->name('category.exportPDF');
        Route::get('category/exportExcel',[CategoryController::class,'exportExcel'])->name('category.exportExcel');

        Route::get('products',[ProductController::class,'index'])->name('products.index');
        Route::post('products',[ProductController::class,'store'])->name('products.store');
        Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{id}', [ProductController::class, 'delete'])->name('products.delete');
        Route::get('products/exportPDFAll',[ProductController::class,'exportPDFAll'])->name('products.exportPDFAll');
        Route::get('products/exportExcel',[ProductController::class,'exportExcel'])->name('products.exportExcel');

        Route::get('bartenders',[BartenderController::class,'index'])->name('bartenders.index');
        Route::post('bartenders',[BartenderController::class,'store'])->name('bartenders.store');
        Route::put('bartenders/{id}',[BartenderController::class,'update'])->name('bartenders.update');
        Route::delete('bartenders/{id}',[BartenderController::class,'delete'])->name('bartenders.delete');
        Route::get('bartenders/exportPDFAll',[BartenderController::class,'exportPDFAll'])->name('bartenders.exportPDFAll');
        Route::get('bartenders/exportPDF/{id}',[BartenderController::class,'exportPDF'])->name('bartenders.exportPDF');
        Route::get('bartenders/exportExcel',[BartenderController::class,'exportExcel'])->name('bartenders.exportExcel');


        Route::get('outgoingproducts',[OutgoingProductController::class,'index'])->name('outgoingproducts.index');
        Route::post('outgoingproducts',[OutgoingProductController::class,'store'])->name('outgoingproducts.store');
        Route::put('outgoingproducts/{id}',[OutgoingProductController::class,'update'])->name('outgoingproducts.update');
        Route::delete('outgoingproducts/{id}',[OutgoingProductController::class,'delete'])->name('outgoingproducts.delete');
        Route::get('outgoingproducts/exportPDFAll',[OutgoingProductController::class,'exportPDFAll'])->name('outgoingproducts.exportPDFAll');
        Route::get('outgoingproducts/exportPDF/{id}',[OutgoingProductController::class,'exportPDF'])->name('outgoingproducts.exportPDF');
        Route::get('outgoingproducts/exportExcel',[OutgoingProductController::class,'exportExcel'])->name('outgoingproducts.exportExcel');

        Route::get('suppliers',[SupplierController::class,'index'])->name('suppliers.index');
        Route::post('suppliers',[SupplierController::class,'store'])->name('suppliers.store');
        Route::put('suppliers/{id}',[SupplierController::class,'update'])->name('suppliers.update');
        Route::delete('suppliers/{id}',[SupplierController::class,'delete'])->name('suppliers.delete');
        Route::get('suppliers/exportPDFAll',[SupplierController::class,'exportPDFAll'])->name('suppliers.exportPDFAll');
        Route::get('suppliers/exportPDF/{id}',[SupplierController::class,'exportPDF'])->name('suppliers.exportPDF');
        Route::get('suppliers/exportExcel',[SupplierController::class,'exportExcel'])->name('suppliers.exportExcel');

        Route::get('incomingproducts',[IncomingProductController::class,'index'])->name('incomingproducts.index');
        Route::post('incomingproducts',[IncomingProductController::class,'store'])->name('incomingproducts.store');
        Route::put('incomingproducts/{id}',[IncomingProductController::class,'update'])->name('incomingproducts.update');
        Route::delete('incomingproducts/{id}',[IncomingProductController::class,'delete'])->name('incomingproducts.delete');
        Route::get('incomingproducts/exportPDFAll',[IncomingProductController::class,'exportPDFAll'])->name('incomingproducts.exportPDFAll');
        Route::get('incomingproducts/exportPDF/{id}',[IncomingProductController::class,'exportPDF'])->name('incomingproducts.exportPDF');
        Route::get('incomingproducts/exportExcel',[IncomingProductController::class,'exportExcel'])->name('incomingproducts.exportExcel');

        
        Route::get('waitress',[WaitressController::class,'index'])->name('waitress.index');
        Route::post('waitress',[WaitressController::class,'store'])->name('waitress.store');
        Route::put('waitress/{id}',[WaitressController::class,'update'])->name('waitress.update');
        Route::delete('waitress/{id}',[WaitressController::class,'delete'])->name('waitress.delete');
        Route::get('waitress/exportPDFAll',[WaitressController::class,'exportPDFAll'])->name('waitress.exportPDFAll');
        Route::get('waitress/exportExcel',[WaitressController::class,'exportExcel'])->name('waitress.exportExcel');

        Route::get('ladiesdrinks',[WaitressController::class,'ladiesdrinks'])->name('ladiesdrinks.index');
        Route::get('ladiesdrinks/exportPDFAll',[WaitressController::class,'ld_exportPDFAll'])->name('ladiesdrinks.exportPDFAll');
        Route::get('ladiesdrinks/exportPDF/{id}',[WaitressController::class,'ld_exportPDF'])->name('ladiesdrinks.exportPDF');
        Route::get('ladiesdrinks/exportExcel',[WaitressController::class,'ld_exportExcel'])->name('ladiesdrinks.exportExcel');
    });
});

