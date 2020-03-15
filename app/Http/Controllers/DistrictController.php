<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Validator;
use DB;
use Session;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::Join('divisions','districts.division_id','=','divisions.id')
            ->select('districts.*','divisions.name as division_name')
        ->orderBy('name','asc')
        
        ->paginate(25);
        $divisions = Division::all();
        return view('district.index',compact('divisions','districts'));
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
            'division_id' => 'required',
        ]);
        $input = $request->all();
        try
        {
            $bug=0;
            $division = District::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','District Successfully Saved!');
            return redirect('district')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('district')->with('status_color','danger');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        $divisions = Division::all();
        $districts = District::all();
        $thanas =  $district->thanas;
        return view('welcome', compact('districts', 'divisions', 'thanas'));
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
        $data=District::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'division_id' => 'required',

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
            Session::flash('flash_message','District Successfully Updated.');
            return redirect('district')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('district')->with('status_color','danger');
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
        $data = District::findOrFail($id);
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
            Session::flash('flash_message','District Successfully Deleted !');
            return redirect('district')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('district')->with('status_color','danger');
        }
    }
}
