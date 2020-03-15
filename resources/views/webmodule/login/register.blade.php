@extends('webmodule.layouts.web-layouts')
@section('content')
<style type="text/css">
  .register_div{
    background: #dadadacc;
    color: #000;
    border: 0px;
  }
  .form-control{
    border: 1px solid #cacbd4;
    height: 40px;
    color: #000;
    z-index: 99999;
  }
  .form-control:focus{
    border: 1px solid #2c3691;
  }
</style>
   <section class="login-block">
    <div class="container">
        <div class="modal-dialog modal-lg reg_model"> 
            <div class="modal-content register_div" > 
                <div class="modal-header"> 
                     <h4 class="modal-title common_header">REGISTRATION HERE</h4>
                </div> 
                <div class="modal-body">  
                <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                 @csrf           
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label lebal_name">USER TYPE</label> 
                                    <select class="form-control" name="user_type" >
                                        <option value="0">--SELECT USER TYPE--</option>
                                        <option value="patient">PATIENT</option>
                                        <option value="affiliate">AFFILIATE</option>
                                    </select>
                                </div> 
                            </div> 
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-5" class="control-label lebal_name">NAME</label> 
                                    <input type="text" class="form-control" id="field-5" name="patient_name"  placeholder="Enter your name" required=""> 
                                </div> 
                            </div>
                            <div class="col-md-4"> 
                                <div class="form-group"> 
                                    <label for="field-5" class="control-label lebal_name">PHONE</label> 
                                    <input type="text" class="form-control decimal" id="field-5" name="phone_no"  placeholder="Enter your Phone" maxlength="16" required>
                                </div> 
                            </div>  
                           <div class="col-md-4"> 
                             <div class="form-group"> 
                                <label for="field-5" class="control-label lebal_name">Email</label> 
                                <input type="email" class="form-control" id='txtEmail' name="email" placeholder="Enter your Email" onblur="checkEmail();" required=""> 
                                <span id="mailvalidMsg"></span>
                             </div> 
                          </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="newPassAdmin">New Password:</label>
                             <input type="password" class="form-control" id="newPassAdmin" value="" name="password" placeholder="given new password" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="confirmPassAdmin">Confirm Password:</label>
                             <input type="password" class="form-control" id="confirmPassAdmin" value="" name="confirm_password" placeholder="confirm password" required>
                            <span id="confirmMsg"></span>
                          </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label lebal_name">ADDRESS</label> 
                                <input type="text" class="form-control"  placeholder="Enter your address" name="address">
                            </div> 
                        </div> 
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label lebal_name">AGE</label> 
                                <input type="number" class="form-control decimal"  placeholder="Enter your age" maxlength="3" name="age">
                            </div> 
                        </div> 
                          <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-6" class="control-label lebal_name">GENDER</label> <select class="form-control" name="gender" >
                                    <option >--SELECT GENDER TYPE--</option>
                                    <option value="1">MALE</option>
                                    <option value="2">FEMALE</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-4"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label lebal_name">Guardiant Phone Number</label> 
                                <input type="text" class="form-control decimal"  placeholder="Enter guardiant phone number"
                                name="guardian_phn" maxlength="16" required>
                            </div> 
                        </div> 
                      <div class="modal-footer col-md-12 pull-right"> 
                        <button type="submit" class="btn btn-danger waves-effect waves-light" id="updateBtn" onclick='Javascript:checkEmail();' style="margin-right:400px;width:161px;font-size: 16px;">Register</button> 
                      </div> 
                    </div>
                  </form>
               </div> 
             </div> 
           </div>
        </div><!-- /.modal --> 
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

    function checkEmail() {
      var email = document.getElementById('txtEmail');
      //var filter = /[A-Z0-9._%+-]+@[A-Z0-9.-]+[A-Z]{2,4}/igm;
      var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!filter.test(email.value)) {
        email.focus;
        $('#mailvalidMsg').html('Please enter a valid email address').css('color', '#be4b49');
        $('#updateBtn').prop('disabled',true);
        return false;
     }else{
        $('#mailvalidMsg').html('Email address is valid').css('color', 'green');
        $('#updateBtn').prop('disabled',false);
     }
  }

 </script> 
@endsection
