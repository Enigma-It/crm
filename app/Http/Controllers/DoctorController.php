<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Doctor;
use App\Models\MedicalDepartment;
use App\Models\BloodGroup;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use App\User;
use Validator;
use Session;
use Auth;
use DB;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['doctorList'] = Doctor::join('medical_department', 'medical_department.id', 'doctors.department')->select('doctors.*', 'medical_department.name as department_name')->paginate(20);
        return view('doctor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['allDesignation'] = EmployeeDesignation::all();
        $data['department_list'] = MedicalDepartment::orderBy('name', 'asc')->get();
        $data['blood_groups'] = BloodGroup::orderBy('group_name', 'asc')->get();
        return view('doctor.add-edit', $data);
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
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'gender' => 'required',
                    'marital_status' => 'required',
                    'blood_group' => 'required',
                    'dob' => 'required',
                    'email' => 'email|required|unique:employees',
                    'department' => 'required',
                    'joining_date' => 'required',
                    'phone_no' => 'required',
                    'present_address' => 'required',
                    'designation' => 'required',
                    'monthly_salary' => 'required',
                ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
                
        $input = $request->all();

        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $upload=$photo->move('storage/app/public/uploads/doctor', $fileName );
            $input['image']=$fileName;
        }

        for($i=1; $i<6; $i++){
           if ($request->hasFile('document'.$i)) {
                $photo=$request->file('document'.$i);
                $fileType=$photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $upload=$photo->move('storage/app/public/uploads/doctor_documents', $fileName );
                if($i != 1){ $input['attachments'] .=','; }else{ $input['attachments'] = ''; }
                $input['attachments'] .=$fileName;
            } 
        }
            
        $input['joining_date'] = date('Y-m-d',strtotime($input['joining_date']));
        $input['dob'] = date('Y-m-d',strtotime($input['dob']));
        $input['password'] = 123456;

        // Appointment Tusks starts
        if(!empty($request->checkup_slot_period) && isset($input['appiontmentArr']) && !empty($input['appiontmentArr'])){
            $input['appointment_details'] = json_encode($input['appiontmentArr']);
            $checkup_period = $request->checkup_slot_period;
            foreach ($input['appiontmentArr'] as $key => $value) {
                $scheduleArr = array();
                if(isset($appointmentSchedule[$value['day_id']])){
                    $scheduleArr = $appointmentSchedule[$value['day_id']];
                }

                $start_time = $value['start_time'];
                $end_time = $value['end_time'];
                while ( $start_time < $end_time) {
                    $scheduleArr[$start_time] = null;
                    $start_time = date('H:i', strtotime('+20 minutes', strtotime($start_time)));
                }
                $appointmentSchedule[$value['day_id']] = json_encode($scheduleArr);
            }
            $input['appointment_day_slot_schedule'] = json_encode($appointmentSchedule);
        }

        try{
            $bug=0;
            $insert= Doctor::create($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            $user_info['name'] = $insert->first_name.' '.$insert->last_name;
            $user_info['email'] = $insert->email;
            $user_info['password'] = bcrypt('123456');
            $user_info['user_type'] = 5;
            $user_info['phone_number'] = $insert->phone_no;
            $user_info['present_address'] = $insert->present_address;
            $user_info['permanent_address'] = $insert->permanent_address;
            User::create($user_info);

            $emp_info['name'] = $user_info['name'];
            $emp_info['email'] = $user_info['email'];
            $emp_info['designation_id'] = $input['designation'];
            $emp_info['user_type'] = 5;
            $emp_info['phone_no'] = $user_info['phone_number'];
            $emp_info['present_address'] = $user_info['present_address'];
            $emp_info['permanent_address'] = $user_info['permanent_address'];
            $emp_info['monthly_salary'] = $input['monthly_salary'];
            $emp_info['joining_date'] = date('Y-m-d',strtotime($input['joining_date']));
            $emp_info['status'] = $input['status']; 
            Employee::create($emp_info);

            Session::flash('flash_message','Doctor Successfully Added !');
            return redirect('doctor')->with('status_color','success');
        }else{
            echo $bug; die;
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
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
       /* $data['doctorInformation'] = Doctor::join('medical_department', 'medical_department.id', 'doctors.department')
            ->leftJoin('blood_group', 'blood_group.id', 'doctors.blood_group')
            ->select('doctors.*', 'medical_department.name as department_name', 'blood_group.group_name')
            ->where('doctors.id', $id)->first();
        return view('doctor.viewProfile', $data);*/

        $doctorData = Doctor::findOrFail($id);
        return view('webmodule.doctor.viewDoctorProfile',compact('doctorData'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blood_groups'] = BloodGroup::orderBy('group_name', 'asc')->get();
        $data['doctorData'] = Doctor::findOrFail($id);
        
        $data['department_list'] = DB::table('medical_department')->orderBy('name', 'asc')->get();
        
        return view('doctor.add-edit', $data);
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
        $data = Doctor::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'gender' => 'required',
                    'marital_status' => 'required',
                    'blood_group' => 'required',
                    'dob' => 'required',
                    'email' => 'email|required',
                    'department' => 'required',
                    'joining_date' => 'required',
                    'phone_no' => 'required',
                    'present_address' => 'required'
                ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
                
        $input = $request->all();
        if ($request->hasFile('image')) {
            $photo=$request->file('image');
            $fileType=$photo->getClientOriginalExtension();
            $fileName=rand(1,1000).date('dmyhis').".".$fileType;
            $upload=$photo->move('storage/app/public/uploads/doctor', $fileName );
            $input['image']=$fileName;
        }

        for($i=1; $i<6; $i++){
           if ($request->hasFile('document'.$i)) {
                $photo=$request->file('document'.$i);
                $fileType=$photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                $upload=$photo->move('storage/app/public/uploads/doctor_documents', $fileName );
                if($i != 1){ $input['attachments'] .=','; }else{ $input['attachments'] = ''; }
                $input['attachments'] .=$fileName;
            } 
        }
            
        $input['joining_date'] = date('Y-m-d',strtotime($input['joining_date']));
        $input['dob'] = date('Y-m-d',strtotime($input['dob']));

        // Appointment Tusks starts
        if(!empty($request->checkup_slot_period) && isset($input['appiontmentArr']) && !empty($input['appiontmentArr'])){
            $input['appointment_details'] = json_encode($input['appiontmentArr']);
            $checkup_period = $request->checkup_slot_period;
            foreach ($input['appiontmentArr'] as $key => $value) {
                $scheduleArr = array();
                if(isset($appointmentSchedule[$value['day_id']])){
                    $scheduleArr = $appointmentSchedule[$value['day_id']];
                }

                $start_time = $value['start_time'];
                $end_time = $value['end_time'];
                while ( $start_time < $end_time) {
                    $scheduleArr[$start_time] = null;
                    $start_time = date('H:i', strtotime('+'.$checkup_period.' minutes', strtotime($start_time)));
                }
                $appointmentSchedule[$value['day_id']] = json_encode($scheduleArr);
            }
            $input['appointment_day_slot_schedule'] = json_encode($appointmentSchedule);
        }

        try{
            $bug=0;
            $data->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Doctor\'s Information Successfully Updated !');
            return redirect('doctor')->with('status_color','warning');
        }else{
            echo $bug; die;
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
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
        $data = Doctor::findOrFail($id);
        $img_path='storage/app/public/uploads/doctor/'.$data['image'];
        if($data['image']!=null and file_exists($img_path)){
           unlink($img_path);
        }
        $action = $data->delete();
        if($action){
            Session::flash('flash_message','Data Successfully Deleted.');
            return redirect()->back()->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
        }
    }

    public function searchDoctor(Request $request){
        $autocomplete = $request->searching_name;
        $data['doctorList'] = Doctor::join('medical_department', 'medical_department.id', 'doctors.department')->select('doctors.*', 'medical_department.name as department_name')
        ->where('doctors.first_name','LIKE', '%'.$autocomplete.'%')
        ->orWhere('doctors.last_name','LIKE', '%'.$autocomplete.'%')
        ->paginate(20);
        $data['autocomplete'] = $autocomplete;
        return view('doctor.index', $data);
    }

    
}
