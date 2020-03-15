<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Validator;
use Image;
use Storage;
use App\Models\Patient;
use App\User;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function order(){
        return view('webmodule.cart.order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required',
            'phone_no' => 'required|unique:patients',
            'email' => 'required|required|unique:patients',
            'password' => 'required',
        ]);
        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0].".";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input = $request->all();
        $maxId = Patient::max('id');
        $input['patient_id'] = 'PBP'.date('y').date('m').str_pad($maxId+1, 4,'0',STR_PAD_LEFT);
        $insert= Patient::create($input);
        try{
            $bug=0;
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug == 0){  
            $userData = array(); 
            $userData['name'] = $request->patient_name;
            $userData['email'] = $request->email;
            $userData['password'] = bcrypt($request->password);
            $userData['phone_number'] = $request->phone_no;
            $userData['present_address'] = $request->address;
            $userData['user_type'] = 6;

           $user =  User::create($userData);

           if(isset($user)){
                if (Auth::attempt ( array (    
                'phone_number' => $user->phone_number,
                'password' => $request->password 
            ) )){
                alert()->success('Success Message', 'Patient Successlly Logged In');
                return redirect('/');    
            }
            else{
            alert()->warning('Warning Message', 'Somethings Error');
            return redirect()->back()->with('status_color','danger');
            }

           }
             

            /*alert()->success('Success Message', 'Patient Successlly Register');
            return redirect('/')->with('status_color','success');*/
        }else{
            alert()->warning('Warning Message', 'Somethings Error');
            return redirect()->back()->with('status_color','danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
