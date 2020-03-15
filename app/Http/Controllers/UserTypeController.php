<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use Validator;
use Session;
class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata'] = UserType::orderBy('user_type', 'asc')->paginate(10);
        return view('userType.userTypeList', $data);
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
        $input  = $request->all();
        $validator = Validator::make($request->all(), [
                    'user_type' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $newData['user_type'] = $request->user_type;
        if(isset($input['access'])){
            $newData['user_role'] = json_encode($input['access']);
        }

        try{
            $bug=0;
            $insert= UserType::create($newData);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','User Type Successfully Saved !');
            return redirect()->back()->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
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
        $data=UserType::findOrFail($id);
        $input=$request->all();
        $validator = Validator::make($input, [
                    'user_type' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $newData['user_type'] = $request->user_type;
        if(isset($input['access'])){
            $newData['user_role'] = json_encode($input['access']);
        }else{
            $newData['user_role'] = null;
        }

        try{
            $bug=0;
            $data->update($newData);
        }catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','User Type Successfully Updated !');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
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
        $data = UserType::findOrFail($id);

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

            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect('user-type')->with('status_color','danger');

        }else{

            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
