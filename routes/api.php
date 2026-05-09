<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AaiisApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('aaiis')->group(function () {
    Route::get('/ts', [AaiisApiController::class, 'SentTsData']);
    Route::get('/wo', [AaiisApiController::class, 'SentWoData']);
    Route::get('/bill', [AaiisApiController::class, 'SentBillData']);
    Route::get('/comexpend', [AaiisApiController::class, 'SentCommitExpendData']);
});