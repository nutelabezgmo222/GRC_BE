<?php
use App\Http\Service\RiskService;
use App\Http\Service\RiskPeriodService;
use App\Http\Service\ControlService;
use App\Http\Service\UsersService;
use App\Http\Service\LoginService;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', [UsersService::class, '_GET']);
Route::post('/user', [UsersService::class, '_POST']);
Route::patch('/user/{id}', [UsersService::class, '_PATCH']);

Route::get('/risks', [RiskService::class, '_GET']);
Route::get('/risk/attributes', [RiskService::class, '_GET_risk_attributes']);
Route::get('/risk/{id}', [RiskService::class, '_GET_risk_by_id']);

Route::post('/risk', [RiskService::class, '_POST']);
Route::post('/risk/attributes', [RiskService::class, '_POST_risk_attributes']);
Route::patch('/risk/attributes/{id}/{type}', [RiskService::class, '_PATCH_risk_attributes']);
Route::delete('/risk/attributes/{id}/{type}', [RiskService::class, '_DELETE_risk_attributes']);
Route::patch('/risk/{id}', [RiskService::class, '_PATCH']);


Route::get('/controls', [ControlService::class, '_GET']);
Route::post('/control', [ControlService::class, '_POST']);
Route::get('/control/{id}', [ControlService::class, '_GET_control_by_id']);
Route::patch('/control/{id}', [ControlService::class, '_PATCH']);

Route::post('/login', [LoginService::class, '_POST_login']);
Route::post('/tokenLogin', [LoginService::class, '_POST_tokenLogin']);
Route::post('/registration', [LoginService::class, '_POST_registration']);
Route::get('/logout', [LoginService::class, '_GET_logout']);