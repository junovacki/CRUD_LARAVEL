<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\userController;

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
    return view('index');
});

Route::get('/retornoLogin', function () {
    return view('index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/dashboard/cadastroFilmes', function () {
    return view('cadastroFilmes');
});

Route::post('/login', [userController::class, 'loginUsuario']);

Route::post('/cadastro', [userController::class, 'cadastroUsuario']);

Route::post('/cadastroFilme', [userController::class, 'cadastroFilme']);

Route::post('/entregaFilme', [userController::class, 'entregaFilme']);
