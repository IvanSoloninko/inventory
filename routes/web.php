<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::resource('stock', \App\Http\Controllers\StockController::class)->except('show', 'destroy');
    Route::get('stock/{stock}/export', [\App\Http\Controllers\StockController::class, 'export'])->name('stock.export');
    Route::get('stock/{stock}/items', [\App\Http\Controllers\StockController::class, 'items'])->name('stock.items');


    Route::get('history', [HomeController::class, 'showHistory'])->name('history');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('inventory', [InventoryController::class, 'list'])->name('inventory.list');
    Route::get('inventory/add', [InventoryController::class, 'add'])->name('inventory.add');
    Route::post('inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::post('inventory/change/{id}', [InventoryController::class, 'change'])->name('inventory.change');

    Route::get('inventory/delete/{id}', [InventoryController::class, 'delete'])->name('inventory.delete');
    Route::get('inventory/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');

    Route::get('inventory/{inventory}/trade', [InventoryController::class, 'showFormTrade'])->name('inventory.trade');
    Route::post('inventory/{inventory}/trade', [InventoryController::class, 'tradeItem'])->name('inventory.trade');
    Route::get('inventory/export', [InventoryController::class, 'export'])->name('inventory.export');
});

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');


    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');



});

