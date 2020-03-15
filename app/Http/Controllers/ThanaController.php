<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;
use Validator;
use DB;
use Session;

class ThanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thanas = Thana::Join('districts','thanas.district_id','=','districts.id')
            ->select('thanas.*','districts.name as district_name')
            ->orderBy('name','asc')
            ->paginate(25);
        $districts = District::all();
        return view('thana.index',compact('thanas','districts'));
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
            'district_id' => 'required',
        ]);
        $input = $request->all();
        try
        {
            $bug=0;
            $division = Thana::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            Session::flash('flash_message','Thana Successfully Saved!');
            return redirect('thana')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('thana')->with('status_color','danger');
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
        $data=Thana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'district_id' => 'required',
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
            Session::flash('flash_message','Thana Successfully Updated.');
            return redirect('thana')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('thana')->with('status_color','danger');
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
        $data = Thana::findOrFail($id);
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
            Session::flash('flash_message','Thana Successfully Deleted !');
            return redirect('thana')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('thana')->with('status_color','danger');
        }
    }
}
