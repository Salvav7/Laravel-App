<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\AdopcionController;

Route::get('/', [IndexController::class, 'index']);
Route::resource('mascotas', MascotasController::class);
Route::resource('servicios', ServiciosController::class);
Route::resource('citas', CitasController::class);
Route::resource('historial_medico', HistorialMedicoController::class);
Route::resource('adopcion', AdopcionController::class);






