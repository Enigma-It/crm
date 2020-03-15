<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Configuration;
use Session;
class CheckCurrency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Session::has('configData')==false){
            $configData = Configuration::first();
            session(['configData'=>$configData]);
        }
        return $next($request);
    }
}
