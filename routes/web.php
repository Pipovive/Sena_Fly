<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VueloController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminReservaController;
use App\Http\Controllers\VueloPublicController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\AvionController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\PagoController ;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', [VueloPublicController::class, 'buscar'])->name('home');
Route::post('/vuelos/buscar', [VueloPublicController::class, 'buscarVuelos'])->name('vuelos.buscar');

Route::get('/vuelos/{vuelo}/asientos', [ReservaController::class, 'elegirAsientos'])->name('vuelos.asientos');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');  // ✅ solo esta

Route::get('/reservas/{codigo}/detalle', [ReservaController::class, 'detalle'])->name('reservas.detalle');

/*
|--------------------------------------------------------------------------
| RUTAS AUTENTICADAS (Dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [VueloController::class, 'dashboard'])->name('dashboard');

    Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/detalle/{codigo}', [ReservaController::class, 'detalle'])->name('reservas.detalle');
    Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show');
    Route::get('/reservas/{reserva}/asientos', [ReservaController::class, 'seleccionarAsientos'])
    ->name('reservas.asientos');
    Route::post('/reservas/asientos', [ReservaController::class, 'seleccionarAsientos'])->name('reservas.asientos');
    Route::post('/reservas/{reserva}/pasajeros', [ReservaController::class, 'guardarPasajeros'])->name('reservas.pasajeros.store');
    Route::get('/reservas/{reserva}/asientos', [ReservaController::class, 'seleccionarAsientos'])
    ->name('reservas.asientos');
    Route::post('/reservas/{reserva}/asientos', [ReservaController::class, 'guardarAsientoYpasajero'])
        ->name('reservas.asientos.store');

        // Mostrar formulario de pago para una reserva
    // Route::get('/reservas/{codigo}/pago', [ReservaController::class, 'mostrarPago'])
    //     ->name('reservas.pago');

    // // Procesar el pago
    // Route::post('/reservas/{codigo}/pago', [ReservaController::class, 'procesarPago'])
    //     ->name('reservas.pago.procesar');

        // Formulario de pag

    Route::get('reservas/{reserva}/pago', [PagoController::class, 'formulario'])->name('pagos.formulario');
    Route::post('reservas/{reserva}/pago', [PagoController::class, 'procesarPago'])->name('pagos.procesar');
    Route::get('pagos/{pago}', [PagoController::class, 'ver'])->name('pagos.ver');
    

    // Pasajeros
    Route::post('/pasajeros', [PasajeroController::class, 'store'])->name('pasajeros.store');
    Route::get('/pasajeros', [PasajeroController::class, 'index'])->name('pasajeros.index');

    // Vuelos en dashboard
    Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| RUTAS ADMINISTRADOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'rol2'])->group(function () {
    Route::get('/admin/reservas', [AdminReservaController::class, 'index'])->name('admin.reservas.index');
    Route::get('/admin/reservas/{id}', [AdminReservaController::class, 'show'])->name('admin.reservas.show');

    Route::resource('ciudades', CiudadController::class)->except(['show']);
    Route::get('/ciudades/{id}/soft-delete', [CiudadController::class, 'softDelete'])->name('ciudades.softDelete');

    Route::resource('aviones', AvionController::class)->except(['show']);
    Route::get('/aviones/{id}/soft-delete', [AvionController::class, 'softDelete'])->name('aviones.softDelete');
    Route::get('/aviones/asignar', [AvionController::class, 'asignar'])->name('aviones.asignar');
    Route::post('/aviones/asignarStore', [AvionController::class, 'asignarStore'])->name('aviones.asignarStore');

    Route::resource('vuelos', VueloController::class)->except(['index', 'show']);
});

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
