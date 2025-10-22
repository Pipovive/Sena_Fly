<?php



// Esta línea carga las rutas de Breeze (incluyendo /login, /register, etc.)
require __DIR__.'/auth.php';
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VueloController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AdminReservaController;
use App\Http\Controllers\VueloPublicController;

Route::get('/welcome', function () {
    return view('welcome');
})->name('/welcome');


Route::get('/dashboard', [VueloController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');

//PASAJEROS
Route::post('/pasajeros', [App\Http\Controllers\PasajeroController::class, 'store'])->name('pasajeros.store');

// Rutas públicas
Route::get('/', [VueloPublicController::class, 'buscar'])->name('home');
Route::post('/vuelos/buscar', [VueloPublicController::class, 'buscarVuelos'])->name('vuelos.buscar');
Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index.public');
Route::get('/vuelos/{vuelo}/asientos', [ReservaController::class, 'seleccionarAsientos'])->name('vuelos.asientos');

Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas/{reserva}/pasajeros', [ReservaController::class, 'formPasajeros'])->name('reservas.pasajeros');
Route::post('/reservas/{reserva}/pasajeros', [ReservaController::class, 'guardarPasajeros'])->name('reservas.pasajeros.store');

Route::get('/reservas/seleccionar-vuelo', [ReservaController::class, 'seleccionarVuelo'])->name('reservas.seleccionarVuelo');
Route::post('/reservas/elegir-asientos', [ReservaController::class, 'elegirAsientos'])->name('reservas.elegirAsientos');
Route::post('/reservas/datos-pasajeros', [ReservaController::class, 'datosPasajeros'])->name('reservas.datosPasajeros');
Route::post('/reservas/confirmar', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');
Route::get('/reservas/{codigo}/detalle', [ReservaController::class, 'detalle'])->name('reservas.detalle');

Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show'); // luego la completamos


Route::get('/pago/{reserva}', [PagoController::class, 'show'])->name('pago.show');
Route::post('/pago/{reserva}', [PagoController::class, 'process'])->name('pago.process');

Route::get('/reserva/{codigo}', [ReservaController::class, 'confirmacion'])->name('reserva.confirmacion');
Route::get('/reserva/{codigo}/pdf', [ReservaController::class, 'pdf'])->name('reserva.pdf');
Route::get('/reservas/{id}', [ReservaController::class, 'show'])->name('reservas.show');

//CIUDADES  



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');

Route::post('/vuelos/buscar', [VueloController::class, 'buscar'])->name('vuelos.buscar');

require __DIR__.'/auth.php';


// Rutas de administrador 
// Gestionar Reservas
Route::middleware(['auth', 'rol2'])->group(function () {
    Route::get('/admin/reservas', [AdminReservaController::class, 'index'])->name('admin.reservas.index');
    Route::get('/admin/reservas/{id}', [AdminReservaController::class, 'show'])->name('admin.reservas.show');


    Route::get('/ciudades', [App\Http\Controllers\CiudadController::class, 'index'])->name('ciudades.index');
    Route::get('/ciudades/create', [App\Http\Controllers\CiudadController::class, 'create'])->name('ciudades.create');
    Route::post('/ciudades', [App\Http\Controllers\CiudadController::class, 'store'])->name('ciudades.store');
    Route::get('/ciudades/{id}/soft-delete', [App\Http\Controllers\CiudadController::class, 'softDelete'])->name('ciudades.softDelete');

    Route::get('/aviones', [App\Http\Controllers\AvionController::class, 'index'])->name('aviones.index');
    Route::get('/aviones/create', [App\Http\Controllers\AvionController::class, 'create'])->name('aviones.create');
    Route::post('/aviones', [App\Http\Controllers\AvionController::class, 'store'])->name('aviones.store');
    Route::get('/aviones/asignar', [App\Http\Controllers\AvionController::class, 'asignar'])->name('aviones.asignar');
    Route::post('/aviones/asignarStore', [App\Http\Controllers\AvionController::class, 'asignarStore'])->name('aviones.asignarStore');
    Route::get('/aviones/{id}/soft-delete', [App\Http\Controllers\AvionController::class, 'softDelete'])->name('aviones.softDelete');   

    Route::get('/vuelos/create', [VueloController::class, 'create'])->name('vuelos.create');
    Route::post('/vuelos', [VueloController::class, 'store'])->name('vuelos.store');
    Route::get('/vuelos/{vuelo}/edit', [VueloController::class, 'edit'])->name('vuelos.edit');
    Route::put('/vuelos/{vuelo}', [VueloController::class, 'update'])->name('vuelos.update');
    Route::delete('/vuelos/{vuelo}', [VueloController::class, 'destroy'])->name('vuelos.destroy');

    Route::get('/pasajeros', [App\Http\Controllers\PasajeroController::class, 'index'])->name('pasajeros.index');

});

