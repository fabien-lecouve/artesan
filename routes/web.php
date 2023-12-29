<?php

use App\Http\Controllers\Auth\LogUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\LocationOfWorkController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ModeOfWorkController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StatusController;
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
    return redirect('login');
});

Route::middleware('guest')->group(function() {

    Route::get('/login', [LogUserController::class, 'login'])->name('login');
    Route::post('/login', [LogUserController::class, 'authenticate'])->name('login.post');

    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

});

Route::middleware('auth')->group(function() {

    Route::get('/logout', [LogUserController::class, 'logout'])->name('logout');

});

// PROFILE
Route::middleware('auth')->prefix('profile')->group(function() {
    Route::get('/show', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/edit', [ProfileController::class, 'update'])->name('profile.update');
});

// CUSTOMER
Route::middleware('auth')->prefix('customer')->group(function() {
    Route::get('/index', [CustomerController::class, 'index'])->name('customer.index');

    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/create', [CustomerController::class, 'store'])->name('customer.store');

    Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('customer.show');

    Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/edit/{customer}', [CustomerController::class, 'update'])->name('customer.update');


});

// ESTIMATE
Route::middleware('auth')->prefix('estimate')->group(function() {
    Route::get('/index', [EstimateController::class, 'index'])->name('estimate.index');

    Route::get('/create', [EstimateController::class, 'create'])->name('estimate.create');
    Route::post('/create', [EstimateController::class, 'store'])->name('estimate.store');

    Route::get('/show/{estimate}', [EstimateController::class, 'show'])->name('estimate.show');
    Route::get('/export-estimate-PDF/{estimate}', [EstimateController::class, 'getEstimatePdf'])->name('estimate.estimate_pdf');
    Route::get('/export-invoice-PDF/{estimate}', [EstimateController::class, 'getInvoicePdf'])->name('estimate.invoice_pdf');

    Route::get('/edit/{estimate}', [EstimateController::class, 'edit'])->name('estimate.edit');
    Route::post('/edit/{estimate}', [EstimateController::class, 'update'])->name('estimate.update');

    // LOCATION OF WORK
    Route::prefix('/{estimate}/location_of_work')->group(function() {
        Route::get('/index', [LocationOfWorkController::class, 'index'])->name('location_of_work.index');

        Route::get('/create', [LocationOfWorkController::class, 'create'])->name('location_of_work.create');
        Route::post('/create', [LocationOfWorkController::class, 'store'])->name('location_of_work.store');

        Route::get('/edit/{location_of_work}', [LocationOfWorkController::class, 'edit'])->name('location_of_work.edit');
        Route::post('/edit/{location_of_work}', [LocationOfWorkController::class, 'update'])->name('location_of_work.update');

        // OPERATION
        Route::prefix('/{location_of_work}/operation')->group(function() {
            Route::get('/create', [OperationController::class, 'create'])->name('operation.create');
            Route::post('/create', [OperationController::class, 'store'])->name('operation.store');
        });
    });
});


// MATERIAL
Route::middleware('auth')->prefix('material')->group(function() {
    Route::get('/index', [MaterialController::class, 'index'])->name('material.index');

    Route::get('/create', [MaterialController::class, 'create'])->name('material.create');
    Route::post('/create', [MaterialController::class, 'store'])->name('material.store');

    Route::get('/show/{material}', [MaterialController::class, 'show'])->name('material.show');

    Route::get('/edit/{material}', [MaterialController::class, 'edit'])->name('material.edit');
    Route::post('/edit/{material}', [MaterialController::class, 'update'])->name('material.update');

    Route::get('/destroy/{material}', [MaterialController::class, 'destroy'])->name('material.destroy');
});

// CATEGORY
Route::middleware('auth')->prefix('category')->group(function() {
    Route::get('/index', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/create', [CategoryController::class, 'store'])->name('category.store');

    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
});

// MODE OF WORK
Route::middleware('auth')->prefix('mode_of_work')->group(function() {
    Route::get('/index', [ModeOfWorkController::class, 'index'])->name('mode_of_work.index');

    Route::get('/create', [ModeOfWorkController::class, 'create'])->name('mode_of_work.create');
    Route::post('/create', [ModeOfWorkController::class, 'store'])->name('mode_of_work.store');

    Route::get('/edit/{mode_of_work}', [ModeOfWorkController::class, 'edit'])->name('mode_of_work.edit');
    Route::post('/edit/{mode_of_work}', [ModeOfWorkController::class, 'update'])->name('mode_of_work.update');
});

// ROOMS
Route::middleware('auth')->prefix('room')->group(function() {
    Route::get('/index', [RoomController::class, 'index'])->name('room.index');

    Route::get('/create', [RoomController::class, 'create'])->name('room.create');
    Route::post('/create', [RoomController::class, 'store'])->name('room.store');

    Route::get('/edit/{room}', [RoomController::class, 'edit'])->name('room.edit');
    Route::post('/edit/{room}', [RoomController::class, 'update'])->name('room.update');
});

// STATUS
Route::middleware('auth')->prefix('status')->group(function() {
    Route::get('/index', [StatusController::class, 'index'])->name('status.index');

    Route::get('/create', [StatusController::class, 'create'])->name('status.create');
    Route::post('/create', [StatusController::class, 'store'])->name('status.store');

    Route::get('/edit/{status}', [StatusController::class, 'edit'])->name('status.edit');
    Route::post('/edit/{status}', [StatusController::class, 'update'])->name('status.update');
});

