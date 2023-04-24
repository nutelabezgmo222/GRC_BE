<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistryService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, $service_id)
    // {
    //     $request = $next($request);
    //     $service = DB::connection('registry')->table('services')->where('id', $service_id)->get()[0];

    //     DB::connection('registry')->table('services')
    //         ->where('id', $service->id)
    //         ->update(['service_calls' => $service->service_calls + 1]);

    //     return $request;
    // }
}
