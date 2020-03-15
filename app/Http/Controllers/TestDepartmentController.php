<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestDepartment;
use Validator;
use DB;
use Session;
use Alert;
class TestDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test_department = TestDepartment::orderBy('name','asc')->get();
        return view('test-dept.index',compact('test_department'));
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
            $testdepartment = TestDepartment::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug==0){
            //Session::flash('flash_message','test-department Successfully Saved!');
            Alert::success('Test Department Successfully Saved!');
            return redirect('test-department');
        }else{
             Alert::error($bug);
            return redirect('test-department');
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
        $data=TestDepartment::findOrFail($id);

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
            $bug = $e->getMessage();
        }

        if($bug==0){
            //Session::flash('flash_message','test-department Successfully Saved!');
            Alert::success('Test Department Successfully updated!');
            return redirect('test-department');
        }else{
             Alert::error($bug);
            return redirect('test-department');
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
        $data = TestDepartment::findOrFail($id);
        try
        {
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug==0){
            //Session::flash('flash_message','test-department Successfully Saved!');
            Alert::success('Successfully Deleted');
            return redirect('test-department');
        }else{
             Alert::error($bug);
            return redirect('test-department');
        }
    }
}
