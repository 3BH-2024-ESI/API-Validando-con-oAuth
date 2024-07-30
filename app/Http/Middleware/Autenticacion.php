<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class Autenticacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $headers = [
            "Accept" => "application/json",
            "ContentType" => "application/json",
            "Authorization" => $request -> header("Authorization")
        ];
        $resultado = Http::withHeaders($headers) 
                        -> get("http://localhost:8000/api/v1/validate");

        if($resultado -> successful())
            return $next($request);
        return response(["message" => "No autorizado"], 403);
    }
}
