<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VendaController;
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
Route::get('/', [HomeController::class, 'index'])->name('index');

//Rotas Serviço
Route::get('servico', [ServicoController::class, 'show']);
Route::get('servico/{id}', [ServicoController::class, 'get']);

//Rotas importação
Route::get('importacao', [ClienteController::class, 'create'])->name('importacao.create');
Route::post('importacao', [ClienteController::class, 'store'])->name('importacao.store');

//Rotas de vendas
Route::get('venda', [VendaController::class, 'show'])->name('venda.show');

//Rotas de Indicadores
Route::get('indicadores/cliente', [VendaController::class, 'cliente'])->name('indicadores.cliente');
Route::post('indicadores/cliente', [VendaController::class, 'buscaCliente'])->name('indicadores.buscaCliente');
Route::get('indicadores/servico', [VendaController::class, 'servico'])->name('indicadores.servico');
Route::post('indicadores/servico', [VendaController::class, 'buscaServico'])->name('indicadores.buscaServico');
Route::get('indicadores/mes', [VendaController::class, 'mes'])->name('indicadores.mes');
Route::post('indicadores/mes', [VendaController::class, 'buscaMes'])->name('indicadores.buscaMes');


