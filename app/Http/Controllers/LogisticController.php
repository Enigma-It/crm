<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use App\User;
use Validator;
use DB;
use Session;
use Hash;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Logistic = Courier::all();
        $user_info = DB::table('couriers')
                        ->join('users','users.user_pluck','couriers.id')
                        ->first();
        return view('logistic.index',compact('Logistic','user_info'));
    }

    public function change_password(Request $request){
       $data=array();
       $data['password']=$request->password;
       $regPassword = bcrypt($request->password);
       $userInfo = DB::table('users')
                      ->where('users.user_pluck',$request->courier_id)
                      ->first();
         if($userInfo){
            $package=DB::table('users')->where('id',$request->courier_id)->update($data);
            Session::flash('flash_message','Logistic password successfully update!');
            return redirect('logistic')->with('status_color','success');
         } else{
             Session::flash('flash_message', 'old password are not matched');
            return redirect('logistic')->with('status_color','warning');
         }                                 
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
            'courier_type' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);

       if($validator->fails())
        {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].".";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input = $request->all();

        try
        {
            $bug=0;
            $logistic = Courier::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
          $userData = array(); 
            $userData['name'] = $request->name;
            $userData['email'] = $request->email;
            $userData['password'] = bcrypt($request->password);
            $userData['phone'] = $request->phone;
            $userData['address'] = $request->address;
            $userData['user_type'] = 10;
            $userData['user_pluck'] = $logistic->id;
           $user =  User::create($userData);
            Session::flash('flash_message','Logistic Information Successfully Saved!');
            return redirect('logistic')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('logistic')->with('status_color','danger');
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
        $data=Courier::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'courier_type' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        if($validator->fails())
        {
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input=$request->all();
        try
        {
            $bug=0;
            $data->update($input);
        }
        catch(\Exception $e)
        {
            $bug = $e->errorInfo[1];
        }

        if($bug==0)
        {
            Session::flash('flash_message','Logistic Successfully Updated.');
            return redirect('logistic')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('logistic')->with('status_color','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = Courier::findOrFail($id);
        try
        {
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','Logistic Successfully Deleted !');
            return redirect('logistic')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('logistic')->with('status_color','danger');
        }
    }
}
