<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CuponesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecursosHumanosController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('artisan', function () {
    Artisan::call('clear-compiled');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    //Artisan::call('optimize');
});

Auth::routes();
Route::view('/', 'auth.login');
Route::get('test-claves', [TestController::class, 'actualizarClaves'])->name('test-claves');

Route::middleware(['auth'])->group(function () {
    Route::get('cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');
    Route::get('inicio', [HomeController::class, 'index'])->name('inicio');
    
    Route::name('promociones.')->prefix('promociones')->group(function () {
        Route::get('cupones', [CuponesController::class, 'cupones'])->name('cupones');
    });

    Route::name('recursos-humanos.')->prefix('recursos-humanos')->group(function () {
        Route::get('permisos', [RecursosHumanosController::class, 'permisos'])->name('permisos');
        Route::post('listar-permiso', [RecursosHumanosController::class, 'listarPermisos'])->name('listar-permiso');
        Route::post('guardar-permiso', [RecursosHumanosController::class, 'guardarPermiso'])->name('guardar-permiso');
        Route::post('aprobar-permiso', [RecursosHumanosController::class, 'aprobarPermiso'])->name('aprobar-permiso');
        Route::post('guardar-sustento', [RecursosHumanosController::class, 'guardarSustento'])->name('guardar-sustento');
        Route::post('historial-permiso', [RecursosHumanosController::class, 'historialPermiso'])->name('historial-permiso');

        Route::get('horas-extras', [RecursosHumanosController::class, 'horas_extras'])->name('horas-extras');

        Route::name('helpers.')->prefix('helpers')->group(function () {
            Route::post('listar-division', [HomeController::class, 'listarDivision'])->name('listar-division');
            Route::post('listar-detalle-permisos', [HomeController::class, 'listarDetallePermiso'])->name('listar-detalle-permisos');
        });
    });
});