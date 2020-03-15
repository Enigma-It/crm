<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use Validator;
use DB;
use Session;
use Auth;

class BloodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata'] = BloodGroup::orderBy('group_name','asc')->paginate(10);
        return view('blood-group.index', $data);
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
                    'group_name' => 'required',
                    'sale_rate' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input  = $request->all();
        try{
            $bug=0;
            $insert= BloodGroup::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Saved!');
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
        $validator = Validator::make($request->all(), [
                    'group_name' => 'required',
                    'sale_rate' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $data = BloodGroup::findOrFail($id);
        $input  = $request->all();
        try{
            $bug=0;
            $data->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Updated!');
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
        $data = BloodGroup::findOrFail($id);
        try{
            $bug=0;
            $delete = $data->delete();
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
