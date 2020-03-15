<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourierSampleCollection;
use App\Models\Courier;
use Validator;
use DB;
use Session;
use Auth;

class CourierSampleCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courierSample = CourierSampleCollection::all();
        return view('courier-sample-collection.index',compact('courierSample'));
    }

    public function courier_collection(){

         $courierInfo = Courier::all();
         return view('courier-sample-collection.add-edit',compact('courierInfo'));
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
            'destination_place' => 'required',
            'arriving_place' => 'required',
            'supervisor_name' => 'required',
            'supervisor_contact_number' => 'required',
            'box_qty' => 'required',
            'collected_date' => 'required',
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
        $input['courier_id'] = Auth::User()->user_pluck;
        $input['collected_date'] = date('Y-m-d',strtotime($request->collected_date));   
        try
        {
            $bug=0;
            $logistic = CourierSampleCollection::create($input);
        }
        catch(\Exception $e)
        {
            $bug=$e->getMessage();
        }
        if($bug===0){
            Session::flash('flash_message','Courier Sample Successfully Saved!');
            return redirect('courier-collection')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('courier-collection')->with('status_color','danger');
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
       $sampleCollection = CourierSampleCollection::findOrFail($id);
       $input['status'] = $request->approve;
       $sampleStatus=DB::table('courier_sample_collection')->where('courier_sample_collection.id',$id)->update($input);
        

        alert()->success('Success Message', 'Sample status update succesfully!!');
        return redirect('courier-collection');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
