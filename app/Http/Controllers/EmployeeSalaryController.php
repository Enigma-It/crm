<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Capital;
use DB;
use Session;
use Auth;
use Validator;
class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $salaryList = EmployeeSalary::leftJoin('employees','employee_salary.employee_id','employees.id')
                                    ->select('employee_salary.*','employees.name as employee_name','employees.image')
                                    ->paginate(10);
        return view('employee-salary.salary-list',compact('salaryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allEmployee = Employee::get();
        return view('employee-salary.employee-salary',compact('allEmployee'));
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
                    'employee_id' => 'required',
                    'year' => 'required',
                    'month' => 'required',
                    'salary' => 'required',
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

        // Updating Main Capital
        $current_capital_data = Capital::findOrFail(1);
        $currentCapital = $current_capital_data->current_capital;
        $newCapital['current_capital'] = $currentCapital - $input['salary'];

        try{
            $bug=0;
            $insert= EmployeeSalary::create($input);
            $current_capital_data->update($newCapital);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Employee Successfully Added.');
            return redirect('employee-salary-list')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect('employee-salary-list')->with('status_color','danger');
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
        $allEmployee = Employee::get();
        $employeeSalary = EmployeeSalary::findOrFail($id);
        return view('employee-salary.employee-salary',compact('allEmployee','employeeSalary'));
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
        $data=EmployeeSalary::findOrFail($id);

        $validator = Validator::make($request->all(), [
                    'employee_id' => 'required',
                    'year' => 'required',
                    'month' => 'required',
                    'salary' => 'required',
                ]);

        if($validator->fails())
        {
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input=$request->all();

        // Updating Main Capital
        $current_capital_data = Capital::findOrFail(1);
        $currentCapital = $current_capital_data->current_capital;
        if($input['salary'] > $data->salary){
            $newCapital['current_capital']=$currentCapital - ($input['salary'] - $data->salary);
        }else{
            $newCapital['current_capital']=$currentCapital + ($data->salary - $input['salary']);
        }

        try{
            $bug=0;
            $data->update($input);
            $current_capital_data->update($newCapital);
        }
        catch(\Exception $e)
        {
            $bug = $e->errorInfo[1];
        }

        if($bug==0)
        {
            Session::flash('flash_message','Employee Salary Successfully Updated.');
            return redirect('employee-salary-list')->with('status_color','warning');
        }
        else
        {
            Session::flash('flash_message','Something Error Found.');
            return redirect('employee-salary-list')->with('status_color','danger');
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
        $data = EmployeeSalary::findOrFail($id);

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

            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect('employee-salary-list')->with('status_color','danger');

        }else{

            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
}
