<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmptyBoxCollection;
use Auth;
use Session;
use DB;
use Validator;
use Image;
use Storage;

class CentralLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emptyBoxCollection = EmptyBoxCollection::all();
        return view('empty-box-collection.empty_box_collection',compact('emptyBoxCollection'));
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
            'dispatch_date' => 'required',
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
        $input['submitted_by'] = Auth::User()->id;
        $input['status'] = 1;   
        try
        {
            $bug=0;
            $boxArr = EmptyBoxCollection::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug===0){
            Session::flash('flash_message','Box Dispatch successfully!');
            return redirect('empty-box-collection')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('empty-box-collection')->with('status_color','danger');
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
      $emptyBoxCollection = EmptyBoxCollection::findOrFail($id);

       $input['status'] = $request->status;
       $sampleStatus=DB::table('empty_box_collection')->where('empty_box_collection.id',$id)->update($input);
        

        alert()->success('Success Message', 'Empty boxcollection status update succesfully!!');
        return redirect('empty-box-collection');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = EmptyBoxCollection::findOrFail($id);
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
            Session::flash('flash_message','Empty box qty successfully deleted !');
            return redirect('empty-box-collection')->with('status_color','danger');

        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect('empty-box-collection')->with('status_color','danger');
        }
        
    }
}
