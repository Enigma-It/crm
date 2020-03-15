<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Auth;
use Session;
use App\Models\Orderdetails;
use App\Models\Order;
use App\User;
use DB;
use Hash;
class LoginController extends Controller
{
    public function loginForm(){
        return view('webmodule.login.login');
    }
     public function registerForm(){
        return view('webmodule.login.register');
    }
    public function usertLogin(Request $request) {
        $userInfo = $request->get('phone_number');
         if (Auth::attempt ( array (    
                'phone_number' => $request->get('phone_number'),
                'password' => $request->get( 'password' ) 
            ) )){
                alert()->success('Success Message', 'Patient Successlly Logged In');
                return redirect('/');    
            }
            elseif(Auth::attempt ( array (
                'email' => $request->get('phone_number' ),
                'password' => $request->get( 'password' ) 
            ) )) {
            
                $userArr = array();
                $userArr['id'] = Auth::User()->id;
                $userArr['name'] = Auth::User()->name;
                $userArr['email'] = Auth::User()->email;
                $userArr['phone_number'] = Auth::User()->phone_number;
                $userArr['address'] = Auth::User()->present_address;
                session ([ 
                    'user_data' =>  $userArr
                ]);
                alert()->success('Success Message', 'User Successlly Logged In');
                return redirect('/');    
            }
            else{
                if(is_numeric($userInfo)){
                  alert()->warning('Error Message', 'Invalid phone number or password');
                  return redirect('/');  
                }else{
                    alert()->warning('Error Message', 'Invalid email or password');
                    return redirect()->back();
                } 
            }
        
    }
    public function userLogout(){
        Session::flush ();
        Auth::logout ();
        return redirect('/');
    }

    public function profile(){
         return view('webmodule.login.profile');
    }

    public function changePassword($id){
         $data = User::findOrFail($id);
         return view('webmodule.login.change-password',compact('data'));
    }
    public function updatePassword(Request $request,$id){
       $data = User::findOrFail($id);
       $authPassword = Auth::User()->password;
       $oldPassword = $request->exist_password;
       if(Hash::check($oldPassword,$authPassword)){
         $input = $request->all();
         $input['password'] = bcrypt($request->password);
         $data->update($input);
         alert()->warning('Successlly Message', 'Password update Successlly!');
         return redirect('patient-profile');
       }else{
        alert()->warning('Error Message', 'Old password not match!');
        return redirect()->back();
       }
       


    }
    public function order(){ 
       $getPatientId =DB::table('patients')
                         ->where('patients.email',Auth::User()->email)
                         ->first();
        $orderDetailsData = DB::table('orders')
                            ->where('orders.patiant_id',$getPatientId->patient_id)
                            ->get();   
         return view('webmodule.login.orderList',compact('orderDetailsData'));
    }
}
