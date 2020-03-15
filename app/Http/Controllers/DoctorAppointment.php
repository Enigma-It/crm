<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\AppointmentBooking;
use App\Models\AppointmentBookingPatient;
use App\Library\memberShipLib;
use Response;
use Validator;
use Session;
use Auth;
use DB;

class DoctorAppointment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['doctorList'] = Doctor::join('medical_department', 'medical_department.id', 'doctors.department')->select('doctors.*','medical_department.name as department_name')->get();
        return view('appointment.doctorAppointment', $data);
    }

    public function loadApponitmentSchedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'doctor_id' => 'required',
                     ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            return redirect()->back();
        }


        $data['doctorList'] = Doctor::join('medical_department', 'medical_department.id', 'doctors.department')->select('doctors.*','medical_department.name as department_name')
        ->get();
        $data['singelDoctorData'] = Doctor::findOrfail($request->doctor_id);
        $data['selectedDoctor'] = $request->doctor_id;

        if (isset($request->date)) {
            $data['startDate'] = $request->date;
        }

        return view('appointment.doctorAppointment', $data);
    }

    public function saveUpdateViewBooking(Request $request)
    {
        $input = $request->all();

        if($input['action'] == 'newBooking'){
            $userArr['name'] = $input['patient_name'];
            $userArr['contact_number'] = $input['patient_number'];
            $savedUser = AppointmentBookingPatient::create($userArr);
            $bookingArr['status'] = $input['booking_status'];
            $bookingArr['date'] = date('Y-m-d', strtotime($input['date']));
            $bookingArr['time'] = $input['time'];
            $bookingArr['booking_patient_id'] = $savedUser->id;
            $bookingArr['doctor_id'] = $input['doctor_id'];
            $bookingArr['visit_payment'] = $input['visit_payment'];
            $bookedData = AppointmentBooking::create($bookingArr); 
            $response = array('result' => true, 'details'=>$bookedData);
            return Response::json($response);
        }

        if($input['action'] == 'getBookingData'){
            $bookedData = AppointmentBooking::leftJoin('appointment_booking_patient', 'appointment_booking_patient.id', 'appointment_booking.booking_patient_id')
                ->where('appointment_booking.id', $input['bookingId'])
                ->select('appointment_booking.*', 'appointment_booking_patient.name', 'appointment_booking_patient.contact_number')
                ->first();
            $response = array('result' => true, 'details'=>$bookedData);
            return Response::json($response);
        }

        if($input['action'] == 'editBooking'){
            $bookingArr['status'] = $input['booking_status'];
            $bookingArr['visit_payment'] = $input['visit_payment'];
            $bookingInfo = AppointmentBooking::findOrfail($input['bookingId']);
            $userArr['name'] = $input['patient_name'];
            $userArr['contact_number'] = $input['patient_number'];
            $userInfo = AppointmentBookingPatient::findOrfail($bookingInfo->booking_patient_id);
            try{
                $bug=0;
                $bookingInfo->update($bookingArr);
                $userInfo->update($userArr);
            }catch(\Exception $e){
                $bug=$e->getMessage();
            }
            if($bug==0){
                $bookedData = AppointmentBooking::findOrfail($input['bookingId']);
                $response = array('result' => true, 'details'=>$bookedData);
            }else{
                $response = array('result' => false, 'details'=>array());
            }
            return Response::json($response);
        }

        if($input['action'] == 'deleteBooking'){
            if(!empty($input['bookingId'])){
                $bookingInfo = AppointmentBooking::findOrfail($input['bookingId']);
                $userInfo = AppointmentBookingPatient::findOrfail($bookingInfo->booking_patient_id);
                $userInfo->delete();
                $bookingInfo->delete();
                $response = array('result' => true, 'details'=>array());
            }else{
                $response = array('result' => false, 'msg'=>'This Slot is already Empty !');
            }
            return Response::json($response);
        }

        if($input['action'] == 'viewBooking'){
            $bookedData = AppointmentBooking::leftJoin('appointment_booking_patient', 'appointment_booking_patient.id', 'appointment_booking.booking_patient_id')
                ->where('appointment_booking.id', $input['bookingId'])
                ->select('appointment_booking.*', 'appointment_booking_patient.name', 'appointment_booking_patient.contact_number')
                ->first();
            $bookedData->date = date('m/d/Y', strtotime($bookedData->date));
            $bookedData->time = date('h:i A', strtotime($bookedData->time));
            if (!empty($bookedData->visit_payment)) {
                $bookedData->visit_payment = memberShipLib::getNumberFormat($bookedData->visit_payment);
            }
            if($bookedData->status==1){ $bookedData->status = "Booked";  }
            if($bookedData->status==2){ $bookedData->status = "Completed";  }
            if($bookedData->status==3){ $bookedData->status = "Cancelled";  }
            $response = array('result' => true, 'details'=>$bookedData);
            return Response::json($response);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        

    }
}
