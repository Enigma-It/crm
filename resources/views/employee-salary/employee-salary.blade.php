<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
  <script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Employee Salary')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-money"></i> Employee Salary</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('employee-salary-list')}}">Employee Salary List</a></li>
    <li class="active"> Employee Salary</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
  	@if( !empty($employeeSalary) )
			{{Form::open(array('route'=>['employee-salary-list.update',$employeeSalary->id],'method'=>'PUT','files'=>true))}}
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
			<?php $display = 'block'; ?>
	@else
 		{!! Form::open(array('route' => 'employee-salary-list.store','class'=>'form-horizontal','method' =>'POST','files'=>true)) !!}
     <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-floppy-o"></i> <b>Save Information</b></button>
     <?php $display = 'none'; ?>
 	@endif
 	&nbsp;&nbsp;<a href="{{  url('employee-salary-list')  }}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b>View Salary List</b></a> 
 </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-money"></i> Salary Info</div>
          <div class="panel-body">

            <div class="form-group">
              <label for="years">Select Month:</label>
              <select class="form-control" name="month" id="month">
                <option value="">Select Month</option>
              @if(isset($employeeSalary)) 
                @foreach(months() as $key => $months)
                  <option value="{{$key}}" {{($employeeSalary->month==$key) ? 'selected':''}}>{{$months}}</option>
                  @endforeach
              @else
                @foreach(months() as $key => $months)
                  <option value="{{$key}}">{{$months}}</option>
                  @endforeach
              @endif
              </select>
            </div>

            <div class="form-group">
                <label for="years">Select Year:</label>
                <select class="form-control" name="year" id="years">
                  <option value="">Select Year</option>
                  @if(isset($employeeSalary))
                    @foreach(years() as $year)
                      <option value="{{$year}}" {{($employeeSalary->year==$year) ? 'selected':''}}>{{$year}}</option>
                      @endforeach
                  @else
                    @foreach(years() as $year)
                      <option value="{{$year}}">{{$year}}</option>
                      @endforeach
                  @endif
                
                </select>
            </div>

            <div class="form-group">
              <label for="employeeList">Select Employee:</label>
                <select class="form-control" name="employee_id" id="employeeList">
                  <option value="">Select Employee</option>
                  @if(!empty($employeeSalary))
                    @foreach($allEmployee as $employee)
                    <option value="{{$employee->id}}" {{($employeeSalary->employee_id==$employee->id) ? 'selected':''}} data-salary="{{$employee->monthly_salary}}">{{$employee->name}}</option>
                    @endforeach
                  @else
                  @foreach($allEmployee as $employee)
                    <option value="{{$employee->id}}" data-salary="{{$employee->monthly_salary}}">{{$employee->name}}</option>
                    @endforeach
                  @endif
                </select>
            </div>

            <div class="form-group">
              <label for="salary">Monthly Salary:</label>
              <input type="text" name="salary" id="salary" value="{{isset($employeeSalary->salary)?$employeeSalary->salary:old('salary')  }}" class="form-control decimal" placeholder="Salary" required readonly>
            </div>
          </div>
        </div>

  	  </div>

  	 {!! Form::close() !!} 
	  </div>
  </div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#employeeList').change(function(){
			var dataSalary = $('#employeeList option:selected').data('salary');
			if($('#employeeList').val() !=''){
				$('#salary').val(dataSalary);
			}
		});
	})
</script>
@endsection
