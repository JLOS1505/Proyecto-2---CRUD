<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\CrudEncargadoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/', [LoginController::class, 'showLoginForm'])->name('crud.index');

// Rutas para mostrar el formulario de registro de usuario
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Ruta para mostrar el Logout
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/producto', [CrudController::class, "index"])->name("crud.index");

Route::get('/encargado', [CrudEncargadoController::class, "index"])->name("crudEncargado.index");

///Ruta para añadir un nuevo producto
Route::post('/registrar-producto', [CrudController::class, "create"])->name("crud.create");

///Ruta para modificar un nuevo producto
Route::post('/modificar-producto', [CrudController::class, "update"])->name("crud.update");

///Ruta para eliminar un nuevo producto
Route::get('/eliminar-producto-{id}', [CrudController::class, "delete"])->name("crud.delete");

///Ruta para añadir un nuevo Encargado
Route::post('/registrar-encargado', [CrudEncargadoController::class, "create"])->name("crud.createEncargado");

///Ruta para modificar un nuevo Encargado
Route::post('/modificar-encargado', [CrudEncargadoController::class, "update"])->name("crud.updateEncargado");

///Ruta para eliminar un nuevo Encargado
Route::get('/eliminar-encargado-{id}', [CrudEncargadoController::class, "delete"])->name("crud.deleteEncargado");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
