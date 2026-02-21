<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Auth\RegisterController;

// Página de inicio
Route::get('/', function () {
    return view('home'); // home.blade.php
})->name('home');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard con reservas
    Route::get('/dashboard', [ReservaController::class, 'index'])->name('dashboard');

    // Crear reserva
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

    // Editar reserva
    Route::get('/reservas/{reserva}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{reserva}', [ReservaController::class, 'update'])->name('reservas.update');

    // Eliminar reserva
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

    // AJAX: obtener habitaciones por tipo
    Route::get('/habitaciones', [HabitacionController::class, 'getHabitaciones'])->name('habitaciones.ajax');

    // Exportar reservas a Excel
    Route::get('/export/reservas', [ExportController::class, 'exportReservas'])->name('export.reservas');

    // Exportar reservas a PDF
    Route::get('/export/reservas/pdf', [ExportController::class, 'exportPDF'])->name('export.reservas.pdf');
});

// Autenticación (Breeze/Jetstream)
require __DIR__.'/auth.php';

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');