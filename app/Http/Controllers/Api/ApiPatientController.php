<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Response;
class ApiPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvData(){

        // $invoiceDataArr = array();
        // $invoiceData = array();
        // $testData = array();
    
        $invData = DB::table('diagnostic_patient_test')->join('diagnostic_patient','diagnostic_patient.patient_id','diagnostic_patient_test.patient_id')->join('pathology_test','diagnostic_patient_test.test_id','pathology_test.id')->where('diagnostic_patient_test.collection_status',1)->select('diagnostic_patient_test.*','pathology_test.test_name','pathology_test.total_price','diagnostic_patient.patient_name','diagnostic_patient.patient_age','diagnostic_patient.patient_phone','diagnostic_patient.date')->get();

        foreach ( $invData as $data) {
             
             $invoiceDataArr[] = array(
                'center_name' => 'Advanced diagnostic and clinical research labrotory, bangladesh',
                'patient_id' => $data->patient_id,
                'patient_name' => $data->patient_name,
                'age' => $data->patient_age,
                'entry_date' => $data->date,
                'mobile_no' => $data->patient_phone,
                'test_id' => $data->test_id,
                'test_name' => $data->test_name,
                'test_cost' => $data->total_price,
                'collection_status' => $data->collection_status

             );
             
        }
         //exit;
                    
        return Response::json($invoiceDataArr);                  

    }
}
