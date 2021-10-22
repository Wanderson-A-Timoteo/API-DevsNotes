<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function (Request $request) {
    return ['pong' => true];
});

// //Lista as notas
Route::get('/notes', 'NoteController@all');

// // Detalhes de uma anotação
// Route::get('/note/{id}', '');

// // Criar uma anotação
// Route::post('/note', '');

// // Editar uma anotação
// Route::put('/note/{id}', '');

// // Excluír uma anotação
// Route::delete('/note/{id}', '');
