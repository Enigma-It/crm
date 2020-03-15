<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestEquipment;
use App\Models\Tests;
use App\Models\DiagnosticPatient;
use App\Models\DiagnosticPatientTest;
use App\Models\DiagnosticTestEquipment;
use App\Models\Doctor;
use App\Models\Configuration;
use Validator;
use DB;
use Session;

class SampleCollectionUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['configuration'] = Configuration::join('currency','settings.currency_id','currency.id')
                                    ->select('settings.*','currency.icon as cur_icon')
                                    ->first();
        return view('diagnostic.sample-collection-status',$data);
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
       $input = $request->all();
        try{
            $bug = 0;
            if(isset($input['patient_test_id'])){
                $patientTest = array();
                foreach ($input['patient_test_id'] as $key => $pId) {
                   $findPatientTest = DiagnosticPatientTest::findOrFail($key);

                   if(isset($findPatientTest)){
                        $patientTest['collection_status'] = $pId['collection_status'];
                        $findPatientTest->update($patientTest);
                   } 
                }
                
            }
            //$getPatient->update($input);
       }
       catch(\Exception $e)
        {   
            
            $bug=$e->getMessage();
        }
       if($bug==0){     
          Session::flash('flash_message','Sample Collection Status Successfully Updated.');
          return redirect('diagnostic')->with('status_color','warning'); 
            
        }else{
            Session::flash('flash_message',$bug);
            return redirect()->route('diagnostic.create')->with('status_color','danger');
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
