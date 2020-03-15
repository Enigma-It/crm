<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Doctor;
use App\Models\MedicalDepartment;
use App\Models\DoctorAppointment;
use App\User;
use Validator;
use Session;
use Auth;

class BookDoctorAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPatientBookingList = DoctorAppointment::orderBy('id','asc')
                        ->paginate(25);
       return view('webmodule.doctor.appointmentList',compact('allPatientBookingList'));
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
                    'patient_name' => 'required',
                    'phone' => 'required',
                ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
             alert()->warning('Error Message', $plainErrorText);
            return redirect()->back();
        }       
        $input = $request->all();
        try{
            $bug=0;
            $insert= DoctorAppointment::create($input);
            
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }

        if($bug==0){
            alert()->success('Success Message', 'Appoinment successFully done, please wait for confirmation message');
            return redirect()->back();
        }else{
            
             alert()->warning('Error Message', $bug);
            return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DoctorAppointment::findOrfail($id);
        $action = $data->delete();

        if($action){
            alert()->success('Success Message', 'Appoinment successFully delete');
            return redirect()->back();
        }else{
            
             alert()->warning('Error Message', 'Something error found');
            return redirect()->back();
        }
    }
}
