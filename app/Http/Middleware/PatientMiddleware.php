<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
class PatientMiddleware
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

    /*    if(Auth::Check()){
            if(Auth::User()->user_type ==6){
                echo "dsdfa";die;
                return redirect('patient-profile');
            }else{
                return redirect('/');
            }
        }else{

          
        }
*/         return $next($request); 
    }
}