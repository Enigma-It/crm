<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use Validator;
use DB;
use Session;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization =  Organization::orderBy('name','asc')->get();
        return view('organization.index',compact('organization'));
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
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
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
            $org = Organization::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','Organization Successfully Saved!');
            return redirect('organization')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('organization')->with('status_color','danger');
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
        $data=Organization::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);
        if($validator->fails())
        {
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');;
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
            Session::flash('flash_message','Organization Successfully Updated.');
            return redirect('organization')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('organization')->with('status_color','danger');
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
       $data = Organization::findOrFail($id);
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
            Session::flash('flash_message','Organization Successfully Deleted !');
            return redirect('organization')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('organization')->with('status_color','danger');
        }
    }
}
