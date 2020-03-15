@extends('layouts.layout')
<?php
	if(Session::has('title')){
		$title = Session::get('title');

	}else{
		$title = 'PMS Panel';
	}
?>
@section('title', $title);
@section('content')
<!-- Content Header (Page header) -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-primary">
    <div class="box-header with-border" align="right">
		{{Form::open(array('route'=>['manage-admin.update',$manageUser->id],'method'=>'PUT','files'=>true))}}
		<button type="submit" class="btn btn-success" id="updateBtn"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button>
		<?php $display = 'block'; ?>
	
 </div>
    <div class="box-body">

      <div class="col-md-7">
        <div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-info-circle"></i>&nbsp;Admin Information:</div>
          <div class="panel-body">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Name:</label>
                 <input type="text" name="name" class="form-control" value="{{$manageUser->name}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Email:</label>
                 <input type="email" name="email" class="form-control" value="{{$manageUser->email}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Phone Number:</label>
                 <input type="text" name="phone_number" class="form-control" value="{{$manageUser->phone_number}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Present Address:</label>
                 <input type="text" name="present_address" class="form-control" value="{{$manageUser->present_address}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Permanent Addres:</label>
                 <input type="text" name="permanent_address" class="form-control" value="{{$manageUser->permanent_address}}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Old Password:</label>
                 <input type="password" class="form-control" id="oldPasswordAdmin" value="" name="exist_password" placeholder="given old password">
              <input type="hidden" class="form-control" id="existPass" value="{{$manageUser->password}}" name="old_password" placeholder="given old password">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="newPassAdmin">New Password:</label>
                 <input type="password" class="form-control" id="newPassAdmin" value="" name="password" placeholder="given new password">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="confirmPassAdmin">Confirm Password:</label>
                 <input type="password" class="form-control" id="confirmPassAdmin" value="" name="confirm_password" placeholder="confirm password">
              	<span id="confirmMsg"></span>
              </div>
            </div>
            
          </div>
        </div>
  	  </div>

      <div class="col-md-5">
        <div class="panel panel-primary">
          <div class="panel-heading"><i class="fa fa-camera"></i>&nbsp;Admin Picture:</div>
          <div class="panel-body">
            <div class="form-group" align="center">
				<div class="select_image" style="width: 80%; height: 413px; border:5px solid #ccc;">
					@if($manageUser->image)
					<img src='{{asset("storage/app/public/uploads/users/$manageUser->image")}}' id="profile-image" style="width: 100%;height: 100%">
					@else
					<img src='{{asset("storage/app/public/uploads/person.jpg")}}' id="profile-image" style="width: 100%;height: 100%">
					@endif

				</div>
			</div>
			<div class="form-group" align="center">
			  <label class="btn btn-success" style="width:80%;">
					    Browse <input type="file" name="image" class="form-control" id="profile-image-select" style="display: none;">
				</label>  
			</div>
          </div>
        </div>
      </div>


  	 {!! Form::close() !!} 
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

            // =============password change==========
             $('#confirmPassAdmin').on('keyup', function () {
             	if($('#oldPasswordAdmin').val()!=''){
			      if ($('#newPassAdmin').val() == $('#confirmPassAdmin').val()) {
			      	$('#updateBtn').prop('disabled',false);
			        $('#confirmMsg').html('Password Matched!!').css('color', 'green');
			      } else {
			      	$('#updateBtn').prop('disabled',true);
			        $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
			      }
			    }else{
			    	$('#updateBtn').prop('disabled',true);
			    	$('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red');	
			    }
    		});
             $('#oldPasswordAdmin').on('keyup',function(){
             	if($('#oldPasswordAdmin').val()!=''){
             		$('#updateBtn').prop('disabled',false);
             		$('#confirmMsg').html('');	
             	}else{
             		$('#updateBtn').prop('disabled',true);
             		$('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red');
             	}
             })
            $('#updateBtn').on('submit',function(){
            	if($('#oldPasswordAdmin').val()!=''){
            		if ($('#newPassAdmin').val() == $('#confirmPassAdmin').val()){
            			return true;
	            	}else{
	            		$('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
	            	
	            		return false;
	            	}	
            	}else{
            		$('#confirmMsg').html('Old password cannot empty while change password!!').css('color', 'red');
            	}
            	
            });
        });
</script>
@endsection
