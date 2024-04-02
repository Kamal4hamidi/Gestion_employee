<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\EmployerController;
use App\Http\Requests\SaveDepRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

Route::get('/validate-account/{email}',[AdminController::class, 'defineAccess']);
Route::post('/validate-account/{email}',[AdminController::class, 'submitDefineAccess'])->name('submitDefineAccess');


//Route securise

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [AppController::class, 'index'])->name('dashboard');

    Route::prefix('departements')->group(function () {
        Route::get('/', [DepartementController::class, 'index'])->name('departement.index');
        Route::get('/create', [DepartementController::class, 'create'])->name('departement.create');
        Route::post('/create', [DepartementController::class, 'store'])->name('departement.store');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departement.edit');
        Route::put('/edit/{departement}', [DepartementController::class, 'update'])->name('departement.update');
        Route::get('/{departement}', [DepartementController::class, 'delete'])->name('departement.delete');
    });

    Route::prefix('employers')->group(function () {
        Route::get('/', [EmployerController::class, 'index'])->name('employer.index');
        Route::get('/create', [EmployerController::class, 'create'])->name('employer.create');
        Route::post('/store', [EmployerController::class, 'store'])->name('employer.store');
        Route::get('/edit/{employer}', [EmployerController::class, 'edit'])->name('employer.edit');
        Route::put('/update/{employer}', [EmployerController::class, 'update'])->name('employer.update');
        Route::get('/delete/{employer}', [EmployerController::class, 'delete'])->name('employer.delete');
        Route::get('/testEmp', [EmployerController::class, 'testEmp'])->name('employer.testEmp');
    });
    
    Route::prefix('configurations')->group(function (){
        Route::get('/',[ConfigurationController::class, 'index'])->name('configuration');
        Route::get('/create',[ConfigurationController::class, 'create'])->name('configuration.create');
        Route::post('/store',[ConfigurationController::class, 'store'])->name('configuration.store');
        Route::get('/delete/{configuration}',[ConfigurationController::class, 'delete'])->name('configuration.delete');
    });
    
    Route::prefix('admin')->group(function (){
        Route::get('/',[AdminController::class, 'index'])->name('admin.index');
        Route::get('/create',[AdminController::class, 'create'])->name('admin.create');
        Route::post('/store',[AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::get('/delete/{admin}',[AdminController::class, 'delete'])->name('admin.delete');

    });
});


Route::get('/test', [EmployerController::class, 'testEmp'])->name('testRequest');
Route::get('/test2', function (){});
