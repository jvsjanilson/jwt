<?php


use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'] );
    Route::post('me', [AuthController::class, 'me']);

});

Route::group(['middleware' => ['apiJWT']], function(){

    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::post('/categorias',[CategoriaController::class, 'store']);
    Route::delete('/categorias/{categoria}',[CategoriaController::class, 'destroy']);
    Route::put('/categorias/{categoria}',[CategoriaController::class, 'update']);

}
);


