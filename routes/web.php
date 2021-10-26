<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicoController;

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
//Rotas Geral
Route::get('/', [HomeController::class, 'index']);

//Rotas Serviço
Route::get('servico', [ServicoController::class, 'show']);
Route::get('servico/{id}', [ServicoController::class, 'get']);

//Rotas importação
Route::get('importacao', [ClienteController::class, 'create'])->name('importacao.create');
Route::post('importacao', [ClienteController::class, 'store'])->name('importacao.store');


