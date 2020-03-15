@extends('webmodule.layouts.web-layouts')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <section class="service-postsec">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="health-post-wapper">
                        <div class="main-content">
                            <div class="panel panel-default user-panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Change Profile</h3> 
                                </div>
                            <form  action="{{ url('update-password/'.Auth::User()->id) }}" method="post"      enctype="multipart/form-data">
                                  @csrf
                                <div class="panel-body">
                                  <div class="profile-detiels">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="name">Patiant Name:</label>
                                             <input type="text" name="phone_number" class="form-control" value="{{$data->name}}">
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="name">Patiant Email:</label>
                                             <input type="text" name="phone_number" class="form-control" value="{{$data->email}}">
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="name">Patiant Name:</label>
                                             <input type="text" name="phone_number" class="form-control" value="{{$data->phone_number}}">
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="name">Old Password:</label>
                                             <input type="password" class="form-control" id="oldPasswordAdmin" value="" name="exist_password" placeholder="given old password" required>
                                             <input type="hidden" class="form-control" id="existPass" value="{{$data->password}}" name="old_password" placeholder="given old password">
                                          </div>
                                        </div>

                                     <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="newPassAdmin">New Password:</label>
                                         <input type="password" class="form-control" id="newPassAdmin" value="" name="password" placeholder="given new password" required>
                                      </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="confirmPassAdmin">Confirm Password:</label>
                                            <input type="password" class="form-control" id="confirmPassAdmin" value="" name="confirm_password" placeholder="confirm password" required>
                                            <span id="confirmMsg"></span>
                                           </div>
                                       </div>
                                       <div class="col-md-12">
                                          <button type="submit" class="btn btn-success text-center" id="updateBtn"><i class="fa fa-floppy-o"></i> <b>Update Information</b></button> 
                                       </div>
                                       </form>  
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <aside class="right-sidebar">
                        <div class="single-widget services-list sub-menu">
                            <h4>User Profile</h4>
                            <ul style="padding-left: 0px;">
                                <li><a href="{{url('patient-profile')}}">Your Profile</a></li>
                                <li><a href="{{ url('update-profile/'.Auth::User()->id) }}">Change Password</a></li>
                                <li><a href="{{url('patient-order')}}">Order History</a></li>
                                <li><a href="{{url('patient-logout')}}">Log
                                        Out</a></li>
                                <form id="logout-form" action="#" method="POST"
                                      style="display: none;">
                                    <input type="hidden" name="_token" value="j2yytbF6JrZxQv7e1wyGyhoX5hRvl9BT6SjLx0EE">
                                </form>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('scripts')
<script src="{{asset('public/js/carousel-slider.js')}}"></script>
<script type="text/javascript"> 
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
</script>
@endsection
