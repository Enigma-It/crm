<?php  
	use App\Library\memberShipLib;
	use App\Library\pmscommon;
	$view = pmscommon::userWiseAccessSelection('');
?>
@if($view==false)
	<script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Doctor Profile')
@section('content')
<section class="content-header">
  <h1><i class="fa fa-user"></i> Doctor Profile</h1>
  <ol class="breadcrumb">
    <li>
    	<a href="{{  url('doctor')  }}" style="font-size: 20px;"><i class="fa fa-list"></i></a>
    </li>
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

  	<div class="row">
		<div class="col-md-3">
			<div class="box box-success">
	   			<div class="box-body">
					<div class="form-group">
						<div class="col-md-12" align="center" style="padding-left: 0px; padding-right: 0px;">
							<div class="select_image" style="width: 175px;height:190px;border:1px solid #ddd;">
								@if(!empty($doctorInformation))
								@if($doctorInformation->image !='')
								<img src='{{asset("storage/app/public/uploads/doctor/$doctorInformation->image")}}' id="profile-image" style="width: 100%;height: 100%">
								@else
								<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
								@endif
								@else
								<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
								@endif
							</div>
							<p style="margin-top:5px; font-weight: bold; font-size: 16px;">{{$doctorInformation->first_name.' '.$doctorInformation->last_name}}</p>
							<table class="table table-striped">
								<tr>
									<td>Department</td>
									<td style="text-align: right;">
										{{$doctorInformation->department_name}}
									</td>
								</tr>
								<tr>
									<td>ID No.</td>
									<td style="text-align: right;">
										{{str_pad($doctorInformation->id, 6, '0', STR_PAD_LEFT)}}
									</td>
								</tr>
								<tr>
									<td>Phone No</td>
									<td style="text-align: right;">
										{{$doctorInformation->phone_no}}
									</td>
								</tr>
								<tr>
									<td>Email</td>
									<td style="text-align: right;">
										{{$doctorInformation->email}}
									</td>
								</tr>
								<tr>
									<td>Status</td>
									<td style="text-align: right;">
										@if($doctorInformation->status==1)
											<label class="label label-success">Active</label>
										@else
											<label class="label label-danger">Inactive</label>
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>
			    </div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="box box-success">
	   			<div class="box-body">
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th colspan="2">Profile</th>
	   					</tr>
	   					<tbody>
	   						<tr>
	   							<td style="width: 40%">Joining Date</td>
	   							<td>{{date('m/d/Y', strtotime($doctorInformation->joining_date))}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Date of Birth</td>
	   							<td>{{date('m/d/Y', strtotime($doctorInformation->dob))}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Gender</td>
	   							<td>{{gender()[$doctorInformation->gender]}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Marital Status</td>
	   							<td>{{maritalStatus()[$doctorInformation->marital_status]}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Blood Group</td>
	   							<td>{{$doctorInformation->group_name}}</td>
	   						</tr>
	   					</tbody>
	   				</table>
	   				<br>
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th colspan="2">Address</th>
	   					</tr>
	   					<tbody>
	   						<tr>
	   							<td style="width: 40%">Present Address</td>
	   							<td>{{$doctorInformation->present_address}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Parmanent Address</td>
	   							<td>{{$doctorInformation->permanent_address}}</td>
	   						</tr>
	   					</tbody>
	   				</table>
	   				<br>
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th>Biography</th>
	   					</tr>
	   					<tbody>
	   						<tr>
	   							<td style="text-align: justify;">{{$doctorInformation->biography}}</td>
	   						</tr>
	   					</tbody>
	   				</table>
	   				<br>
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th colspan="2">Professional Details</th>
	   					</tr>
	   					<tbody>
	   						<tr>
	   							<td style="width: 40%">Work Experience</td>
	   							<td>{{$doctorInformation->work_experience}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Specialist</td>
	   							<td>{{$doctorInformation->specialist}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Educational Qualifications</td>
	   							<td>{{$doctorInformation->educational_qualification}}</td>
	   						</tr>
	   					</tbody>
	   				</table>
	   				<br>
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th colspan="2">Appointment Details</th>
	   					</tr>
	   					<tbody>
	   						<tr>
	   							<td style="width: 40%">Checkup Slot Period</td>
	   							<td>
	   								@if(!empty($doctorInformation->checkup_slot_period))
	   									{{$doctorInformation->checkup_slot_period}} Min
	   								@endif
	   							</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Visit (For New Patient)</td>
	   							<td>{{memberShipLib::getNumberFormat($doctorInformation->new_patient_visit)}}</td>
	   						</tr>
	   						<tr>
	   							<td style="width: 40%">Visit (For Old Patient)</td>
	   							<td>{{memberShipLib::getNumberFormat($doctorInformation->old_patient_visit)}}</td>
	   						</tr>
	   					</tbody>
	   				</table>
	   				<br>
	   				@if(isset($doctorInformation->appointment_details) && !empty($doctorInformation->appointment_details))
	   				<table class="table table-bordered">
	   					<tr style="background-color: #ECECED">
	   						<th colspan="2">Appointment Schedule</th>
	   					</tr>
	   					<tbody>
							@foreach(json_decode($doctorInformation->appointment_details, true) as $value)
								<tr>
		   							<td style="width: 40%">{{weeks()[$value['day_id']]}}</td>
		   							<td>
		   								{{date('h:i A', strtotime($value['start_time']))}} 
		   								&nbsp; - &nbsp;
		   								{{date('h:i A', strtotime($value['end_time']))}}
		   							</td>
		   						</tr>
							@endforeach
	   					</tbody>
	   				</table>
	   				@endif
	   			</div>
	   		</div>
		</div>
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
</script>
@endsection
