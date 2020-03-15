<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use Auth;
use Route;
use App\Library\pmscommon;
use Illuminate\Support\Facades\Request;
class UserRoleWiseAccess
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
        $currentAction = \Route::currentRouteAction();
        list($controller, $method) = explode('@', $currentAction);
        $currentControllerName = preg_replace('/.*\\\/', '', $controller);
        session(['currentControllerName'=>$currentControllerName]);
        if(Auth::user()->user_type == 6){ 
             $uri = Request::path();  
             if($uri == 'login' || $uri == 'dashboard'){
                return redirect('/');
             }
        }
        if(Auth::user()->id != 1){  

            //Session Will Set Onces if user is not Admin 
            if(Session::has('userAccessData')==false){
                
                
                $userAccessData = Auth::user()->userTypeObj->user_role;
                $hasAccess = 0;

                if($userAccessData != null){
                    $DbUserAccessData = json_decode($userAccessData, true);
                    foreach($DbUserAccessData as $fncAccess){
                        if(isset($fncAccess['view']) || isset($fncAccess['add_edit']) || isset($fncAccess['delete'])){
                           $hasAccess++; 
                        }
                    }
                }else{
                    return redirect('login');
                }

                if($hasAccess == 0){
                    session()->flush();
                    session(['error'=> 'Access Denied ! You have not got access permission yet.']);
                    return redirect('login');
                }

                session(['userAccessData'=>$userAccessData]);
            }

            if($currentControllerName == "dashboardController"){
                return $next($request);
            }
        
            // It Takes two Parameter (1st = Action, 2nd = Controller)
            $result = pmscommon::userWiseAccessSelection();
            if($result==true){
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return $next($request);
        }
    }
}
