<?php

use App\Http\Controllers\UsuarioController;

use App\Models\Usuario;

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Usuarios routes
Route::get('get-usuarios', [UsuarioController::class, 'index']);
Route::get('get-usuario/{usuario}', [UsuarioController::class, 'show']);
Route::post('set-usuario', [UsuarioController::class, 'store']);
Route::put('update-usuario/{usuario}', [UsuarioController::class, 'update']);
Route::delete('delete-usuario/{usuario}', [UsuarioController::class, 'destroy']);
Route::get('get-usuarios-trashed', [UsuarioController::class, 'getOnlyTrashed']);
Route::put('restore-usuario-trashed/{id}', [UsuarioController::class, 'restoreTrashed']);