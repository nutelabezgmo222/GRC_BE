<?php
use App\Http\Service\ToyService;
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

Route::get('/toys', [ToyService::class, '_GET']);


// $services = DB::connection('registry')->table('services')->get();

// foreach($services as $service) {
//     $class = 'App\Http\Service\\'.$service->service_name;
//     $classInstance = new $class();
//     $middleware = 'registry:'.$service->id;

//     switch ($service->service_http_method) {
//         case 'GET':
//             Route::get($service->service_url, [get_class($classInstance), $service->service_method])->middleware($middleware);
//             break;
//         case 'POST':
//             Route::post($service->service_url, [get_class($classInstance), $service->service_method])->middleware($middleware);
//             break;
//         case 'PATCH':
//             Route::patch($service->service_url, [get_class($classInstance), $service->service_method])->middleware($middleware);
//             break;
//         case 'DELETE':
//             Route::delete($service->service_url, [get_class($classInstance), $service->service_method])->middleware($middleware);
//             break;
//         default:
//             break;
//     }
// }