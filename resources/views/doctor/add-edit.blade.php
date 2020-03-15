<?php  
	use App\Library\pmscommon;
	$add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
	<script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Doctor Profile')
@section('content')
<section class="content-header">
  <h1><i class="fa fa-user-plus"></i> Doctor Profile</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('users')}}">Users</a></li>
    <li class="active">Add Doctor</li>
  </ol>
</section>
<style type="text/css">
	.form-control {
    	height: 28px;
    	padding: 0px 12px;
	}
</style>
<section class="content">
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-success">
  	@if( !empty($doctorData) )
		{{Form::open(array('route'=>['doctor.update',$doctorData->id],'method'=>'PUT','files'=>true))}}
		<?php $btn = "Update Information"; ?>
	@else
		{{Form::open(array('route'=>['doctor.store'],'method'=>'POST','files'=>true))}}
		<?php $btn = "Save Information"; ?>
	@endif
    <div class="box-header with-border" align="right">
		<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> 
			<b>{{$btn}}</b>
		</button>
		 &nbsp;&nbsp; 
		<a href="{{  url('doctor')  }}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b> View Doctor List</b></a> 
	</div>

   <div class="box-body">
    <div class="col-md-9">
	   <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-info-circle"></i> Doctor Information</div>
          <div class="panel-body">
          	<div class="col-md-4">
				<div class="form-group">
			      <label for="first_name">First Name:</label>
			      <input type="text" name="first_name" class="form-control" value="{{isset($doctorData->first_name)?$doctorData->first_name:old('first_name')  }}" placeholder="Enter First Name" required>
			    </div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
			      <label for="last_name">Last Name:</label>
			      <input type="text" name="last_name" class="form-control" value="{{isset($doctorData->last_name)?$doctorData->last_name:old('last_name')  }}" placeholder="Enter Last Name" required>
			    </div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="department" >Department: </label>
					<select name="department" class="form-control" required="">
						<option value="">----Select----</option>
						@foreach($department_list as $department)
						<option value="{{$department->id}}" {{isset($doctorData->department)?($doctorData->department==$department->id)?'selected':'':''}}>{{$department->name}}</option>
						@endforeach
					</select>
				</div>
			 </div>
			<div class="col-md-4">
				<div class="form-group">
			      <label for="email">Email:</label>
			      <input type="email" name="email" class="form-control" value="{{isset($doctorData->email)?$doctorData->email:old('email')  }}" placeholder="somthing@example.com" id="email" required>
			    </div>
			</div>
			<div class="col-md-4">
			  	<div class="form-group">
			      <label for="phone_no">Phone Number:</label>
			      <input type="text" name="phone_no" class="form-control" id="phoneNo" value="{{isset($doctorData->phone_no)?$doctorData->phone_no:old('phone_no')  }}" placeholder="01**************"  placeholder="01***********" required="">
			    </div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="gender" >Gender: </label>
					<select name="gender" class="form-control" required="">
						<option value="">----Select----</option>
						@foreach(gender() as $gender_id=>$gender_name)
						<option value="{{$gender_id}}" {{isset($doctorData->gender)?($doctorData->gender==$gender_id)?'selected':'':''}}>{{$gender_name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="marital_status" >Marital Status: </label>
					<select name="marital_status" class="form-control" required="">
						<option value="">----Select----</option>
						@foreach(maritalStatus() as $maritalStatus_id => $maritalStatus_name)
						<option value="{{$maritalStatus_id}}" {{isset($doctorData->marital_status)?($doctorData->marital_status==$maritalStatus_id)?'selected':'':''}}>{{$maritalStatus_name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="blood_group" >Blood Group: </label>
					<select name="blood_group" class="form-control" required="">
						<option value="">----Select----</option>
						@foreach($blood_groups as $bloodinfo)
						<option value="{{$bloodinfo->id}}" {{isset($doctorData->blood_group)?($doctorData->blood_group==$bloodinfo->id)?'selected':'':''}}>{{$bloodinfo->group_name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="dob" >DOB: </label>
					@if(!empty($doctorData->dob))	
					<input type="text" class="form-control wsit_datepicker" name="dob" placeholder="01/01/20XX" value="{{date('m/d/Y',strtotime($doctorData->dob))}}" required>
					@else
					<input type="text" class="form-control wsit_datepicker" name="dob" placeholder="01/01/20XX" required>
					@endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				<label for="joining_date">Date Of Joining: </label>
				@if(!empty($doctorData->joining_date))	
				<input type="text" class="form-control wsit_datepicker" value="{{date('m/d/Y',strtotime($doctorData->joining_date))}}" name="joining_date" placeholder="01/01/20XX" required>
				@else
				<input type="text" class="form-control wsit_datepicker" name="joining_date" placeholder="01/01/20XX" required>
				@endif
				</div>
			 </div>
			 <div class="col-md-4">
			 	<div class="form-group">
					<label for="work_experience" >Work Experience: </label>
					<input type="text" name="work_experience" class="form-control" value="{{isset($doctorData->work_experience)?$doctorData->work_experience:old('work_experience')  }}">
				</div>
			</div>
			<div class="col-md-4">
			 	<div class="form-group">
					<label for="status" >Status: </label>
					@if( !empty($doctorData) )
						{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$doctorData->status, ['class' => 'form-control'])}}
					@else
					<select name="status" class="form-control" required="">
					<option value="">----Select Status----</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
					@endif
				</div>
			</div>
			@if(!isset($doctorData))
			<div class="col-md-4">
				<div class="form-group">
					<label for="designation">Designation:</label>
					<select class="form-control" name="designation">
						<option value="">-- Select --</option>
						@foreach($allDesignation as $allDesignationInfo)
						<option value="{{$allDesignationInfo->id}}">
							{{$allDesignationInfo->name}}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="monthly_salary">Monthly Salary:</label>
					<input type="text" name="monthly_salary" class="form-control" placeholder="Monthly Salary" value="">
				</div>
			</div>
			@endif
			<div class="col-md-6">
				<div class="form-group">
			      <label for="preAdd">Present Address:</label>
			      <textarea name="present_address" class="form-control" required="">{{isset($doctorData->present_address)?$doctorData->present_address:old('present_address')  }}</textarea>
			    </div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
			      <label for="perAdd">Permanent Address:</label>
			      <textarea name="permanent_address" class="form-control">{{isset($doctorData->permanent_address)?$doctorData->permanent_address:old('permanent_address')  }}</textarea>
			    </div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="biography">Biography:</label>
					<textarea name="biography" class="form-control">{{isset($doctorData->biography)?$doctorData->biography:old('biography')  }}</textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="specialist">Specialist:</label>
					<textarea name="specialist" class="form-control">{{isset($doctorData->specialist)?$doctorData->specialist:old('specialist')  }}</textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="educational_qualification">Educational Qualifications:</label>
					<textarea name="educational_qualification" class="form-control">{{isset($doctorData->educational_qualification)?$doctorData->educational_qualification:old('educational_qualification')  }}</textarea>
				</div>
			</div>
          </div>
       </div>  
	</div>

	<div class="col-md-3">
		<div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-camera"></i> Profile Image</div>
          <div class="panel-body">
          	<div class="form-group">
				<div class="col-md-12" align="center">
					<div class="select_image" style="width: 175px;height:190px;border:1px solid #ddd;">
						@if(!empty($doctorData))
						@if($doctorData->image !='')
						<img src='{{asset("storage/app/public/uploads/doctor/$doctorData->image")}}' id="profile-image" style="width: 100%;height: 100%">
						@else
						<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
						@endif
						@else
						<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
						@endif
					</div>
					<label class="btn btn-info btn-xs" style="width: 175px;margin-top: 2px;">
					    Browse <input type="file" name="image" class="form-control" id="profile-image-select" style="display: none;">
					</label>
				</div>
			</div>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-paperclip"></i> Attachment</div>
          <div class="panel-body">
          	<div class="form-group">
				<div class="col-md-12" style="margin: 6px 0px;">
					<input type="file" name="document1" class="form-control" style="padding:3px 3px;height:30px;">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="margin: 6px 0px;">
					<input type="file" name="document2" class="form-control" style="padding:3px 3px;height:30px;">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="margin: 6px 0px;">
					<input type="file" name="document3" class="form-control" style="padding:3px 3px;height:30px;">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="margin: 6px 0px;">
					<input type="file" name="document4" class="form-control" style="padding:3px 3px;height:30px;">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="margin: 6px 0px;">
					<input type="file" name="document5" class="form-control" style="padding:3px 3px;height:30px;">
				</div>
			</div>
          </div>
        </div>
	</div>

	<div class="col-md-12">
	   	<div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-clock-o"></i> Appiontment Schedule </div>
          <div class="panel-body">
          	<div class="col-md-4">
				<div class="form-group">
					<label for="checkup_slot_period">Checkup Slot Period (Min):</label>
					<input type="text" name="checkup_slot_period" class="form-control" placeholder="Checkup Slot Period" value="{{isset($doctorData->checkup_slot_period)?$doctorData->checkup_slot_period:old('checkup_slot_period')}}">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="new_patient_visit">Visit (For New Patient):</label>
					<input type="text" name="new_patient_visit" class="form-control" value="{{isset($doctorData->new_patient_visit)?$doctorData->new_patient_visit:old('new_patient_visit')}}">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="old_patient_visit">Visit (For Old Patient):</label>
					<input type="text" name="old_patient_visit" class="form-control" value="{{isset($doctorData->old_patient_visit)?$doctorData->old_patient_visit:old('old_patient_visit')}}">
				</div>
			</div>
          	<div class="col-md-12">
				<table class="table table-responsive table-hover table-striped">
					<tr style="background: #D9EDF7;">
						<th>Weekly Checkup Day</th><th>Time Start From</th><th>Time End To</th>
						<th style="text-align: center;">
							<button type="button" onclick="addNewRow();" data-toggle="tooltip" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></button>
						</th>
					</tr>
					<?php $num_row = 0; ?>  
					<tbody id="time_table">
						@if(isset($doctorData->appointment_details) && !empty($doctorData->appointment_details))
							@foreach(json_decode($doctorData->appointment_details, true) as $value)
								<tr id="tr_{{$num_row}}">
									<td>
										<select name="appiontmentArr[{{$num_row}}][day_id]" class="form-control">
											<option>--- Select a Day ---</option>
											@foreach(weeks() as $week_id => $week_name)
											<option value="{{$week_id}}" {{($value['day_id']==$week_id)?'selected':''}}>{{$week_name}}</option>
											@endforeach
										</select>
									</td>
									<td>
										<input type="time" name="appiontmentArr[{{$num_row}}][start_time]" class="form-control" value="{{$value['start_time']}}">
									</td>
									<td>
										<input type="time" name="appiontmentArr[{{$num_row}}][end_time]" class="form-control" value="{{$value['end_time']}}">
									</td>
									<td align="center">
										<button type="button" onclick="$('#tr_{{$num_row}}').remove();" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
									</td>
								</tr>
								<?php $num_row++; ?>
							@endforeach
						@else
							<tr id="tr_{{$num_row}}">
								<td>
									<select name="appiontmentArr[{{$num_row}}][day_id]" class="form-control">
										<option>--- Select a Day ---</option>
										@foreach(weeks() as $week_id => $week_name)
										<option value="{{$week_id}}">{{$week_name}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<input type="time" name="appiontmentArr[{{$num_row}}][start_time]" class="form-control">
								</td>
								<td>
									<input type="time" name="appiontmentArr[{{$num_row}}][end_time]" class="form-control">
								</td>
								<td align="center">
									<button type="button" onclick="$('#tr_{{$num_row}}').remove();" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>
								</td>
							</tr>
						<?php $num_row++; ?>
						@endif  
					</tbody>
				</table>
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

	  var rowNumber = '{{$num_row}}';
	  function addNewRow(){
	  	var html = "";
	  	html += '<tr id="tr_'+rowNumber+'">';
		html += '<td>';
		html += '<select name="appiontmentArr['+rowNumber+'][day_id]" class="form-control">';
		html += '<option>--- Select a Day ---</option>';
				@foreach(weeks() as $week_id => $week_name)
		html += '<option value="{{$week_id}}">{{$week_name}}</option>';
				@endforeach
		html += '</select>';
		html += '</td>';
		html += '<td>';
		html += '<input type="time" name="appiontmentArr['+rowNumber+'][start_time]" class="form-control">';
		html += '</td>';
		html += '<td>';
		html += '<input type="time" name="appiontmentArr['+rowNumber+'][end_time]" class="form-control">';
		html += '</td>';
		html += '<td align="center">';
		html += '<button type="button" onclick="$(\'#tr_'+rowNumber+'\').remove();" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-minus-circle"></i></button>';
		html += '</td>';
		html += '</tr>';
		rowNumber++;
		$("#time_table").append(html);
	  }
</script>
@endsection
