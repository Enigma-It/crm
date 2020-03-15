<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestDepartment;
use App\Models\PathologyTest;
use Validator;
use DB;
use Session;
use Alert;
class PathologyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testList = PathologyTest::where('status',1)->paginate(30);
        return view('pathology-test.test-list',compact('testList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testDepartment = TestDepartment::where('status','1')->get();
        return view('pathology-test.entry-test',compact('testDepartment'));
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
            'test_name' => 'required',
            'total_price' => 'required'
        ]);
        $input = $request->all();

        try
        {
            $bug=0;
            $test = PathologyTest::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug==0){
            //Session::flash('flash_message','pathology-test Successfully Saved!');
            Alert::success('Test Entry Successfully Saved!');
            return redirect('pathology-test');
        }else{
             Alert::error($bug);
            return redirect('pathology-test');
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
        $testData = PathologyTest::findOrFail($id);
        $testDepartment = TestDepartment::where('status','1')->get();
        return view('pathology-test.entry-test',compact('testDepartment','testData'));
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
       $data=PathologyTest::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'test_name' => 'required',
            'total_price' => 'required'

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
            //Session::flash('flash_message','pathology-test Successfully Saved!');
            Alert::success('Pathology Test Successfully updated!');
            return redirect('pathology-test');
        }else{
             Alert::error($bug);
            return redirect('pathology-test');
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
        $data = PathologyTest::findOrFail($id);
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
            //Session::flash('flash_message','pathology-test Successfully Saved!');
            Alert::success('Successfully Deleted');
            return redirect('pathology-test');
        }else{
             Alert::error($bug);
            return redirect('pathology-test');
        }
    }
}
