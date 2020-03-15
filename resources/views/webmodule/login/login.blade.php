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
        <div class="modal-dialog modal-lg log_model"> 
            <div class="modal-content register_div"> 
                <div class="modal-header"> 
                     <h4 class="modal-title common_header_login common-fornt">LOGIN HERE</h4>
                </div> 
                <div class="modal-body">  
                <form action="{{url('patient-login')}}" method="POST" enctype="multipart/form-data">
                  @csrf           
                <div class="row">  
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-5" class="control-label lebal_name common-fornt">Email/Phone Number</label> 
                            <input type="text" class="form-control" id="field-5" name="phone_number" placeholder="Enrer your phone or email" required> 
                        </div> 
                    </div> 
                    <div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-6" class="control-label lebal_name common-fornt">Password</label> 
                            <input type="Password" class="form-control" id="field-6" name="password" placeholder="password" required> 
                        </div> 
                    </div>   
                  <div class="modal-footer col-md-6"> 
                    <button type="submit" class="btn btn-danger  btn-lg waves-effect waves-light" style="width: 250px;" >Login</button> 
                </div> 

                <div class="modal-footer col-md-6t"> 
                    <a type="button" href="{{URL::to('register-form')}}" class="btn btn-primary  btn-lg waves-effect waves-light" style="width: 250px;">Register</a> 
                </div> 
             </div> 
              </form>
               </div> 
             </div> 
           </div>
        </div><!-- /.modal -->
</section>
@endsection
@section('scripts')
<script src="{{asset('public/js/carousel-slider.js')}}"></script>
@endsection
