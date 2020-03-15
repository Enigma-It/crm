@extends('layouts.layout')
@section('title', "Employee Details of $employeeData->name")
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    $view = pmscommon::userWiseAccessSelection('view');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-user"></i> Franchise Details of {{$employeeData->name}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="{{URL::to('employee-list')}}">Franchise</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">
            <div class="box-header with-border" align="right">
                
                <a href="{{ url('employee-list') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>All Employee List</b></a>
            </div>

            <div class="box-body">
               
                <div class="table-responsive">
                	
                    <table class="table table-striped table-responsive">
                    	
                    	<tr>
                    		<td colspan="" class="pull-left">
                                
                            </td>
                            <td></td>
                            <td></td>
                    		<td  class="pull-right">
                    				<div class="select_image" style="width: 250px; height: 275px; border:1px solid #ddd;">
										@if(!empty($employeeData))
										@if($employeeData->image !='')
										<img src='{{asset("storage/app/public/uploads/employee/$employeeData->image")}}' id="profile-image" style="width: 100%;height: 100%">
										@else
										<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
										@endif
										@else
										<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
										@endif
									</div>
                    			
                    		</td>
                    	</tr>
                    	<tr>
                    		<td colspan="" class="pull-left">
                                <h3>Role &nbsp;:&nbsp;&nbsp;<b style="color: #bb3839">{{$employeeData->getType->user_type}}</b> 
                                </h3>      
                            </td>
                            <td></td>
                            <td></td>
                    		<td  class="pull-right">
                    				<h3>Designation &nbsp;&nbsp;:&nbsp;&nbsp;<b style="color: #bb3839">{{$employeeData->getDesignation->name}}</b></h3>
                    			
                    		</td>
                    	</tr>
                    	<tr>
                    		<td>Name</td>
                    		<td><label>{{$employeeData->name}}</label></td>
                    		<td>Mobile</td>
                    		<td><label>{{$employeeData->phone_no}}</label></td>
                    	</tr>
                    	<tr>
                    		<td>Joining Date</td>
                    		<td><label>{{date('d/m/Y',strtotime($employeeData->joining_date))}}</label></td>
                    		<td>Email</td>
                    		<td><label>{{$employeeData->email}}</label></td>
                    	</tr>
                    	<tr>
                    		<td>Division</td>
                    		<td><label>
                    			@if(isset($employeeData->divisionName))
                    			{{$employeeData->divisionName->name}}
                    			@endif
                    		</label></td>
                    		<td>District</td>
                    		<td><label>
                    			@if(isset($employeeData->districtName))
                    			{{ $employeeData->districtName->name }}
                    	@endif</label></td>
                    			
                    	</tr>
                    	<tr>
                    		<td>Thana</td>
                    		<td><label>
                    			@if(isset($employeeData->thanaName))
                    			{{$employeeData->thanaName->name}}
                    			@endif
                    		</label></td>
                    		<td>Address</td>
                    		<td><label>{{$employeeData->present_address}}</label></td>
                    			
                    	</tr>
                    	<tr>
                    		<td>Permanent Address</td>
                    		<td><label>{{$employeeData->permanent_address}}</label></td>
                    		<td>Regisn Date</td>
                    		<td><label>
                    			@if(!empty($employeeData->resign_date))
                    			{{date('d/m/Y',strtotime($employeeData->resign_date))}}
                    			@else
                    				Continue 
                    			@endif
                    		</label></td>
                    			
                    	</tr>
                    	
                    		<td>Monthly Salary</td>
                    		<td><label>{{$employeeData->monthly_salary}}</label></td>
                    		<td>Gross Salary</td>
                    		<td><label>{{$employeeData->gross_salary}}
                    		</label></td>
                    			
                    	</tr>
                    	
                    	
                    	
                    </table>
                   
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"> </div>
            <!-- /.box-footer-->
        </div>
    </section>
    <!-- /.content -->
    <script type="text/javascript">
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection