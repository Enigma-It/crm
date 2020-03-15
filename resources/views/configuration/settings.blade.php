@extends('layouts.layout')
@section('title', 'Settings')
@section('content')

<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-gear"></i>General Settings</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Settings</li>
  </ol>
</section>
<style type="text/css">
	.themebox{
		margin-right: 5px;
	}
</style>
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
{{Form::open(array('route'=>['configration.update',$data->id],'method'=>'PUT','files'=>true))}}
    <div class="box-header with-border" align="right">
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
		&nbsp;&nbsp; 
	</div>

   <div class="box-body">
   	<div class="col-md-12">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab" style="padding-top: 30px;">



				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-4">
					 <div class="form-group" align="center">
	                    <div class="select_image" style="width: 200px; height: 200px; border:1px solid #ddd;">
	                    	@if(isset($data) && $data->logo != null)
	                        <img src='{{asset("storage/app/public/uploads/theme_settings/$data->logo")}}' id="card-image" style="width: 100%;height: 100%">
	                        @else
	                        <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="card-image" style="width: 100%;height: 100%">
	                        @endif
	                     </div>
	                     <label class="btn btn-success" style="width: 200px;margin-top: 5px;">
	                        Upload Logo <input type="file" name="logo" class="form-control" id="card-image-select" style="display: none;">
	                    </label>
					</div>
				</div>


				<div class="col-md-8">
					<div class="form-group">
						<label for="button_hover_color" class="control-label">Company Name:</label>
						<input type="text" name="company_name" class="form-control" value="{{isset($data->company_name)?$data->company_name:old('company_name')  }}">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="currency_position" class="control-label">Contact:</label>
				        <input type="text" name="contact" class="form-control" value="{{isset($data->contact)?$data->contact:old('contact')}}">
					</div>
				</div>


				<div class="col-md-8">
					<div class="form-group">
						<label for="currency_space" class="control-label">Address:</label>
			          	<input type="text" name="address" class="form-control" value="{{isset($data->address)?$data->address:old('address')  }}">
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<label for="currency_position" class="control-label">Center Agent Commision:</label>
				        <input type="text" name="central_agent_com" class="form-control" value="{{isset($data->central_agent_com)?$data->central_agent_com:old('central_agent_com')}}">
					</div>
				</div>
				
			  	<div class="col-md-4">
					<div class="form-group">
						<label for="currency_position" class="control-label">Division Agent Commision:</label>
			          	<input type="text" name="division_agent_com" class="form-control" value="{{isset($data->division_agent_com)?$data->division_agent_com:old('division_agent_com')}}">
					</div>
				</div>
				 

				<div class="col-md-4">
					<div class="form-group">
						<label for="currency_position" class="control-label">District Agent Commision:</label>
			          	<input type="text" name="dis_agent_com" class="form-control" value="{{isset($data->dis_agent_com)?$data->dis_agent_com:old('dis_agent_com')}}">
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label for="currency_space" class="control-label">Report Delivery Time Limite: </label>
			          	<input type="text" name="report_delivery_time_limit" class="form-control" value="{{isset($data->report_delivery_time_limit)?$data->report_delivery_time_limit:old('report_delivery_time_limit')}}">
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
	function getState(id){
		$('#stateId').load('{{ URL::to('default-state')}}/'+id);
	}
	$("#storeTag").tagsinput('items');


    $("#card-image-select").change(function(){
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#card-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

</script>
@endsection
