<?php

use App\Http\Controllers\CustomerController;
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
    return view('welcome');
});

//customer
Route::group(['prefix' => 'customer'], function () {
    Route::get('register', [CustomerController::class, 'register'])->name('customer#register');
    Route::post('create', [CustomerController::class, 'create'])->name('customer#create');

    Route::get('list', [CustomerController::class, 'list'])->name('customer#list');
    Route::get('seeMore/{id}', [CustomerController::class, 'seeMore'])->name('customer#seeMore');
    Route::get('delete/{id}', [CustomerController::class, 'delete'])->name('customer#delete');
    Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer#edit');

    Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer#update');
    Route::get('confirm', [CustomerController::class, 'confirm'])->name('customer#confirm');

    Route::get('realUpdate', [CustomerController::class, 'realUpdate'])->name('customer#realUpdate');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
