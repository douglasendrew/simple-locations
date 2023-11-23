<?php

use App\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->prefix('/location')->group(function() {
    /**
     * Criando Local
     *
     * Insira um local no banco de dados.
     */
    Route::post('/create', [LocationsController::class, 'createLocation']);


    /**
     * Editando Local
     *
     * Edite um local utilizando este endpoint.
     */
    Route::post('/edit/{location_id}', [LocationsController::class, 'editLocation']);


    /**
     * Pesquisando um local
     *
     * Obtenha informações sobre um local específico.
     */
    Route::get('/search/{location_term}', [LocationsController::class, 'searchLocation']);


    /**
     * Todos Locais
     *
     * Obtenha uma lista de todos locais cadastrados.
     */
    Route::get('/all', [LocationsController::class, 'allLocations']);


    /**
     * Deletando um local
     *
     * Delete um local.
     */
    Route::put('/delete/{location_id}', [LocationsController::class, 'deleteLocation']);
});
