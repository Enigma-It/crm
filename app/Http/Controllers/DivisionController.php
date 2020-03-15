<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Validator;
use DB;
use Session;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::orderBy('name','asc')->get();
        
        return view('division.index',compact('divisions'));
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
        ]);
        $input = $request->all();

        try
        {
            $bug=0;
            $division = Division::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','Division Successfully Saved!');
            return redirect('division')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('division')->with('status_color','danger');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        $divisions = Division::all();
        $districts =  $division->districts;
        $thanas = [];
        return view('franchise', compact('districts', 'divisions', 'thanas'));
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
        $data=Division::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',

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
            Session::flash('flash_message','Division Successfully Updated.');
            return redirect('division')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('division')->with('status_color','danger');
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
        $data = Division::findOrFail($id);
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
            Session::flash('flash_message','Division Successfully Deleted !');
            return redirect('division')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('division')->with('status_color','danger');
        }
    }

    public function addBangaldesh(){
        dd('bdsabfj');
    }

}
