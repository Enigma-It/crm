<?php  
	use App\Library\pmscommon;
	$add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
	<script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Add/Edit Employee')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-user-plus"></i> Add/Edit Employee</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('users')}}">Users</a></li>
    <li class="active">Add Employee</li>
  </ol>
</section>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
 	
    <div class="box-header with-border" align="right">
		@if( !empty($employeeData) )
			{{Form::open(array('route'=>['employee-list.update',$employeeData->id],'method'=>'PUT','files'=>true))}}
			<button type="submit" class="btn btn-success submit_btn"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
		@else
			{{Form::open(array('route'=>['employee-list.store'],'method'=>'POST','files'=>true))}}
			<button type="submit" class="btn btn-success submit_btn"><i class="fa fa-floppy-o"></i> <b>Save Information</b></button>
		@endif &nbsp;&nbsp; 
			<a href="{{  url('employee-list')  }}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b> View Employee List</b></a> 
	</div>
   <div class="box-body">

    <div class="col-md-8">
	   <div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-info-circle"></i> Employee Info</div>
          <div class="panel-body">
          	<div class="col-md-12">
				<div class="form-group">
			      <label for="name">Name:</label>

			      <input type="text" name="name" class="form-control" value="{{isset($employeeData->name)?$employeeData->name:old('name')  }}" placeholder="Give your name" required id="">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="email">Email:</label>
			      <input type="email" name="email" class="form-control" value="{{isset($employeeData->email)?$employeeData->email:old('email')  }}" placeholder="somthing@example.com" id="email" required>
			    </div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
				<label for="designation">Designation: </label>
				<select name="designation_id" class="form-control" id="designation">
		          	<option>Select Designation</option>
		          	@if( !empty($employeeData) )
		          		@foreach($allDesignation as $designation)
		          			<option value="{{$designation->id}}" {{($employeeData->designation_id==$designation->id) ? 'selected' : '' }}>{{$designation->name}}</option>
		          		@endforeach
		          	@else
		          		@foreach($allDesignation as $designation)
		          			<option value="{{$designation->id}}">{{$designation->name}}</option>
		          		@endforeach
		          	@endif
		         </select>
				</div>
			  </div>


			  <div class="col-md-12">
				  <div class="form-group">
					  <label for="division">Division: </label>
					  <select name="division_id" class="form-control" id="division">
						  <option>Select Division</option>
						  @if( !empty($employeeData) )
							  @foreach($allDivision as $division)
								  <option value="{{$division->id}}" {{($employeeData->division_id==$division->id) ? 'selected' : '' }}>{{$division->name}}</option>
							  @endforeach
						  @else
							  @foreach($allDivision as $division)
								  <option value="{{$division->id}}">{{$division->name}}</option>
							  @endforeach
						  @endif
					  </select>
				  </div>
			  </div>


			  <div class="col-md-12">
				  <div class="form-group">
					  <label for="District">District: </label>
					  <select name="district_id" class="form-control" id="districtId">
						  <option>Select District</option>
						  @if( !empty($employeeData) )
							  @foreach($allDistrict as $district)
								  <option value="{{$district->id}}" {{($employeeData->district_id==$district->id) ? 'selected' : '' }}>{{$district->name}}</option>
							  @endforeach
						  @else
							
						  @endif
					  </select>
				  </div>
			  </div>


			  <div class="col-md-12">
				  <div class="form-group">
					  <label for="thana">Thana: </label>
					  <select name="thana_id" class="form-control" id="thanaId">
						  <option value="0">Select Thana</option>
						  @if( !empty($employeeData) )
							  @foreach($allThana as $thana)
								  <option value="{{$thana->id}}" {{($employeeData->thana_id==$thana->id) ? 'selected' : '' }}>{{$thana->name}}</option>
							  @endforeach
						  @else
							 
						  @endif
					  </select>
				  </div>
			  </div>


			  <div class="col-md-12">
			  	<div class="form-group">
			      <label for="phoneNo">Phone Number:</label>
			      <input type="text" name="phone_no" class="form-control" id="phoneNo" value="{{isset($employeeData->phone_no)?$employeeData->phone_no:old('phone_no')  }}" placeholder="01**************"  placeholder="01***********">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="preAdd">Present Address:</label>
			      <input type="text" name="present_address" id="preAdd" value="{{isset($employeeData->present_address)?$employeeData->present_address:old('present_address')  }}" class="form-control" placeholder="Give your present address">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="perAdd">Permanent Address:</label>
			      <input type="text" name="permanent_address" id="perAdd" class="form-control" value="{{isset($employeeData->permanent_address)?$employeeData->permanent_address:old('permanent_address')  }}" placeholder="Give your parmanent address">
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="monthlySalary">Monthly Salary:</label>
			      <input type="text" name="monthly_salary" id="monthlySalary" value="{{isset($employeeData->monthly_salary)?$employeeData->monthly_salary:old('monthly_salary')  }}" class="form-control" placeholder="Monthly Salary">
			    </div>
			</div>

			  <div class="col-md-12">
				  <div class="form-group">
					  <label for="grossSalary">Gross Salary:</label>
					  <input type="text" name="gross_salary" id="grossSalary" value="{{isset($employeeData->gross_salary)?$employeeData->gross_salary:old('gross_salary')  }}" class="form-control" placeholder="Gross Salary">
				  </div>
			  </div>

			<div class="col-md-12">
				<div class="form-group">
				<label for="joiningDate">Joining Date: </label>
				@if(!empty($employeeData->joining_date))	
				<input type="text" class="form-control wsit_datepicker" id="joiningDate" value="{{date('m/d/Y',strtotime($employeeData->joining_date))}}" name="joining_date" placeholder="01/01/20XX">
				@else
				<input type="text" class="form-control wsit_datepicker" id="joiningDate" name="joining_date" placeholder="01/01/20XX">
				@endif
				</div>
			 </div>

			<div class="col-md-12">
				<div class="form-group">
				<label for="resignDate">Resign Date: </label>
				@if(!empty($employeeData))	
				@if($employeeData->resign_date !='')	
				<input type="text" class="form-control wsit_datepicker" id="resign_date" value="{{date('m/d/Y',strtotime($employeeData->resign_date))}}" name="resign_date" placeholder="01/01/20XX">
				@else
				<input type="text" class="form-control wsit_datepicker" id="resign_date" name="resign_date" placeholder="01/01/20XX">
				@endif
				@else
				<input type="text" class="form-control wsit_datepicker" id="resign_date" name="resign_date" placeholder="01/01/20XX">
				@endif
				</div>
			 </div>
			
			 <div class="col-md-12">
			 	<div class="form-group">
					<label for="resignDate" >Status: </label>
					@if( !empty($employeeData) )
						{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$employeeData->status, ['class' => 'form-control'])}}
					@else
					<select name="status" class="form-control">
					<option value="">----Select Status----</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
					@endif
				</div>
			 </div>
          </div>
       </div>  
		
	</div>

	<div class="col-md-4" style="">
		<div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-camera"></i> Profile Image</div>
          <div class="panel-body">
          		<div class="form-group">
				<div class="col-md-12" align="center">
					
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
					<label class="btn btn-success" style="width: 250px;margin-top: 5px;">
					    Browse <input type="file" name="image" class="form-control" id="profile-image-select" style="display: none;">
					</label>
				</div>
			</div>
          </div>
        </div>
	</div>
	<div class="col-md-4">
	   	<div class="panel panel-primary">
          <div class="panel-heading"> [ Give Access Permission to an Employee ]</div>
          <div class="panel-body">
          	<div class="col-md-12">
				<div class="form-group">
			      <label for="user_type">User Type (optional) :</label>
			      <!-- <input type="text" name="name" class="form-control" value="{{isset($employeeData->name)?$employeeData->name:old('name')  }}" placeholder="Give your name" required id=""> -->
			      <select class="form-control" name="user_type">
			      	<option value="0">Select User Type</option>
			      		@if(isset($employeeData))
			      			@foreach($all_user_types as $user_types_info)
					      	<option value="{{$user_types_info->id}}" {{($employeeData->user_type==$user_types_info->id)?'selected':''}}>{{$user_types_info->user_type}}</option>
					      	@endforeach
			      		@else
			      			@foreach($all_user_types as $user_types_info)
					      	<option value="{{$user_types_info->id}}">{{$user_types_info->user_type}}</option>
					      	@endforeach
			      		@endif
			      </select>

			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="password">Employee ID:</label>
		      	  <input type="text" class="form-control" name="employee_id" placeholder="employee id" value="{{isset($employeeData->employee_id)?$employeeData->employee_id:old('employee_id')  }}" required>
	
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="password">Given Password:</label>
		      	  <input type="password" class="form-control" id="newPass" value="" name="password" placeholder="given new password">
	
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
			      <label for="confirmPass">Confirm Password:</label>
		      	   <input type="password" class="form-control" id="confirmPass" value="" name="confirm_password" placeholder="confirm password">
              		<span id="confirmMsg"></span>
	
			    </div>
			</div>
			
		  </div>
		</div>
	</div>


	</div>
  	{!! Form::close() !!} 
   </div>
</section>
<script type="text/javascript">
	  $(document).ready(function(){
            function readURL(input) {
                if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile-image').attr('src', e.target.result);
                }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profile-image-select").change(function(){
                readURL(this);
            });
        });
	  $(function() {
	  		$('select[name=division_id]').change(function() {
                var did = $(this).val();
                $('#districtId').load('{{ URL::to('load-district')}}/'+did);

            });
            $('select[name=district_id]').change(function() {
                var id = $(this).val();

                $('#thanaId').load('{{ URL::to('load-thana')}}/'+id);

            });
            

    });

</script>
@endsection
