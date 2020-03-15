<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
use Illuminate\Http\Request;
use Response;
use App\Models\Employee;
use App\Models\EmployeeDesignation;
use App\Models\UserType;
use App\User;
use Session;
use Image;
use Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $allEmployee = Employee::leftJoin('employee_designation','employees.designation_id','=','employee_designation.id')
                    ->select('employees.*','employee_designation.name as designation')
                    ->orderBy('id','desc')
                    ->paginate(10);
       return view('employees.index',compact('allEmployee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['allDesignation'] = EmployeeDesignation::all();
        $data['all_user_types'] = UserType::all();
        $data['allDivision'] = Division::all();
        $data['allDistrict'] = District::all();
        $data['allThana']= Thana::all();
        return view('employees.add-edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchEmployee(Request $request){
        $autocomplete = $request->user_search;
        $searchEmployee = Employee::leftJoin('employee_designation','employees.designation_id','=','employee_designation.id')
                    ->where('employees.name','LIKE', '%'.$autocomplete.'%')
                    ->select('employees.*','employee_designation.name as designation')
                    ->orderBy('id','desc')
                    ->paginate(10);
        return view('employees.index',compact('searchEmployee','autocomplete')); 
   }

    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'email|required|unique:employees',
                    'designation_id' => 'required',
                    'joining_date' => 'required',
                    'phone_no' => 'required',
                    'password' => 'required',
                    'present_address' => 'required'
                ]);
        if($validator->fails())
        {
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
            /*$fileName=$photo->getClientOriginalName();*/
            $upload=$photo->move('storage/app/public/uploads/employee', $fileName );
            $input['image']=$fileName;
        }else{
            $input['image'] = '';
        }
        $input['joining_date'] = date('Y-m-d',strtotime($input['joining_date']));
        if($input['resign_date'] !=''){
            $input['resign_date'] = date('Y-m-d',strtotime($input['resign_date']));
        }

        $input['branch_id'] = 1;



        try{
            $bug=0;
            $insert= Employee::create($input);
        }catch(\Exception $e){
            $bug=$e->getMessage();
        }
        if($bug===0){

            if($request->user_type!=0){
                $user_info['name'] = $insert->name;
                $user_info['email'] = $insert->email;
                $user_info['password'] = bcrypt($request->password);
                $user_info['user_type'] = $request->user_type;
                $user_info['phone_number'] = $insert->phone_no;
                $user_info['present_address'] = $insert->present_address;
                $user_info['permanent_address'] = $insert->permanent_address;
                if($request->hasFile('image')){
                    $user_info['image'] = $input['image'];
                }else{
                    $user_info['image'] ='';
                }
                User::create($user_info);
            }

            Session::flash('flash_message','Employee Successfully Added.');
            return redirect('employee-list')->with('status_color','success');
        }else{
            Session::flash('flash_message',$bug);
            return redirect('employee-list')->with('status_color','danger');
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
       $employeeData = Employee::findOrFail($id);
       return view('employees.employee-data',compact('employeeData'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['allDesignation'] = EmployeeDesignation::all();
        $data['all_user_types'] = UserType::all();
        $data['employeeData'] = Employee::findOrFail($id);
        $data['allDivision'] = Division::all();
        $data['allDistrict'] = District::all();
        $data['allThana']= Thana::all();
        return view('employees.add-edit',$data);
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
        $data= Employee::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'name'  => 'required',
                    'email' => 'email|required',
                    'image' => 'image|Max:500'
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
        $input = $request->all();

        if ($request->hasFile('image')) {
                $photo=$request->file('image');
                $fileType=$photo->getClientOriginalExtension();
                $fileName=rand(1,1000).date('dmyhis').".".$fileType;
                /*$fileName=$photo->getClientOriginalName();*/
                $upload=$photo->move('storage/app/public/uploads/employee', $fileName );
                $input['image']=$fileName;
                 $img_path='storage/app/public/uploads/employee/'.$data['image'];
            if($data['image']!=null and file_exists($img_path)){
                   unlink($img_path);
                }
            }else{
            $input['image'] = $data->image;
        }
           
           $input['joining_date'] = date('Y-m-d',strtotime($input['joining_date']));
            if($input['resign_date'] !=''){

            $input['resign_date'] = date('Y-m-d',strtotime($input['resign_date']));
            }
           $update = $data->update($input);
        try{
            $result=0;
        }catch(\Exception $e){
                $result = $e->getMessage();
            }
        if($result==0){
            $checkUser = User::where('email', $request->email)->count();
            if($checkUser > 0){
               $userData = User::where('email', $request->email)->first();
               $user_info['user_type'] = $request->user_type;
               $user_info['email'] = $request->email;
               $user_info['name'] = $request->name;
               if($request->hasFile('image')){
                $user_info['image'] = $input['image'];
               }else{
                $user_info['image'] = $userData->image;
               }
               if($request->password !='' || $request->password !=null){
                    $user_info['password'] = bcrypt($request->password);

               }
               $userData->update($user_info);
            }else{
                if($request->user_type!=0){
                    $user_info['name'] = $request->name;
                    $user_info['email'] = $request->email;
                    $user_info['password'] = bcrypt($request->password);
                    $user_info['user_type'] = $request->user_type;
                    $user_info['phone_number'] = $request->phone_no;
                    $user_info['present_address'] = $request->present_address;
                    $user_info['permanent_address'] = $request->permanent_address;

                    if($request->hasFile('image')){
                        $user_info['image'] = $input['image'];
                    }else{
                        $user_info['image'] = $data->image;
                    }
                    User::create($user_info);
                }
            }
            Session::flash('flash_message','Employee Successfully Updated.');
            return redirect('employee-list')->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect('employee-list')->with('status_color','danger');
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
        $data = Employee::findOrFail($id);
         $img_path='storage/app/public/uploads/employee/'.$data['image'];
        if($data['image']!=null and file_exists($img_path)){
           unlink($img_path);
        }
        $action = $data->delete();
        if($action)
        {
            Session::flash('flash_message','Employee Successfully Deleted.');
            return redirect('employee-list')->with('status_color','danger');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('employee-list')->with('status_color','danger');
        }
    }
}
