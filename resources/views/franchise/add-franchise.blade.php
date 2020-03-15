@extends('layouts.layout')
@section('title', 'Franchise Add')
@section('content')
    <?php
    use App\Library\pmscommon;
    $add_edit = pmscommon::userWiseAccessSelection('add_edit');
    $delete = pmscommon::userWiseAccessSelection('delete');
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class="fa fa-users"></i> Franchise Add</h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="">Franchise</a></li>
        </ol>
    </section>

    <style type="text/css">
        .output {
            margin: 0 auto;
            padding: 1em;
        }
        .franchise_header{
            color:#ec2328;
            font-family: 'Pacifico', cursive;
            font-weight: 400;
        }
        .page-header-modern{
            padding-top: 20px;
            margin-bottom: 20px;
        }

        .register-btn{
            background: #ec2328 !important;
            color: #fff;
            font-size: 26px;
            padding: 10px 30px;
            border-radius: 9px;
        }
        .register-btn:hover{
            color: #fff;
        }
        label{
            float: left;
        }
        .upload-file-section{
            padding: 20px 10px;
            
        }
    </style>
    <section class="content">
        <!-- Default box -->
        @include('common.message')
        <div class="box box-success">

            <div class="box-header with-border" align="right">

                <form id="contactForm"  action="{{ route('agent-franchise.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{-- <div class="contact-form-success alert alert-success d-none mt-4" id="contactSuccess">
                         <strong>Success!</strong> Your message has been sent to us.
                     </div>--}}

                    {{--<div class="contact-form-error alert alert-danger d-none mt-4" id="contactError">
                          <strong>Error!</strong> There was an error sending your message.
                          <span class="mail-error-message text-1 d-block" id="mailErrorMessage"></span>
                      </div>--}}

                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label class="control-label">Franchise Contact Person</label>
                            <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="control-label">Mobile</label>
                            <input type="text" value="" data-msg-required="mobile number" class="form-control" name="mobile" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="control-label">Sex</label>
                            <select class="form-control" name="sex">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label class="control-label">DOB</label>
                            <input type="text" value="" data-msg-required="date of birth." maxlength="100" class="form-control wsit_datepicker" name="dob" id="dob">
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="control-label">Division</label>
                            <select name="division_id" class="form-control">
                                <option value="0">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{  $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="control-label">District</label>
                            <select name="district_id" id="districtId" class="form-control">
                                <option value="0">Select District</option>

                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="control-label">Thana</label>
                            <select class="form-control" name="thana_id" id="thanaId">
                                <option value="0">Select Thana</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label class="font-weight-bold text-dark text-2">Email</label>
                            <input type="email" value="" data-msg-required="Please enter the subject." class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group col-lg-4">
                            <label class="font-weight-bold text-dark text-2">Address</label>
                            <textarea type="address" value="" data-msg-required="Please enter the address." class="form-control" name="address" id="address"></textarea>
                        </div>
                    </div>

                   <div class="form-group col-lg-6" align="center">
                         
                        <div class="upload-file-section" >
                            <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="license-image" style="width: 100%;height: 100%">
                            </div>
                            <!-- <input type="file" name="trade_license" class="form-control" id="license-image-select"  accept="image/*" capture="camera"> -->
                            <label class="btn btn-success" style="width: 100%;margin-top: 15px;float: left;">
                                Upload Trade License <input type="file" name="trade_license" class="form-control" id="license-image-select" style="display: none;width: 100%" accept="image/*" capture="camera">
                            </label>    
                        </div>
                    </div>
                    <div class="form-group col-lg-6" align="center">
                        <div class="upload-file-section" >
                           
                            <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="card-image" style="width: 100%;height: 100%">
                            </div>
                            <label class="btn btn-success" style="width: 100%;margin-top: 15px;">
                                Upload Business Card <input type="file" name="business_card" class="form-control" id="card-image-select" style="display: none;width: 100%">
                            </label>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="control-label">Organization Type</label>
                            <select id="organizationselector" class="form-control" name="organization_type" required>
                                <option value="">Select Type</option>
                                <option value="1">Hospital</option>
                                <option value="2">Clinic</option>
                                <option value="3">Diagnostic Center</option>
                                <option value="4">Nursing Home</option>
                                <option value="5">Doctor Chamber</option>
                                <option value="6">Pharmacy</option>
                                <option value="7">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="output">
                        <div id="1" class="org_form">
                            <div class="row">

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Hospital Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Speciality</label>
                                    <input type="text" class="form-control input_disable" name="speciality">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Bed</label>
                                    <input type="text" class="form-control input_disable" name="bed">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>In Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_indoor_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Out Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_outdoor_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >ICU</label>
                                    <select class="form-control input_disable" name="icu">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >NICU</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >CT Scan</label>
                                    <select class="form-control input_disable" name="ct_scan">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >MRI</label>
                                    <select class="form-control input_disable" name="mri">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >USG</label>
                                    <select class="form-control input_disable" name="usg">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div id="2" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Clinic Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Speciality</label>
                                    <input type="text" class="form-control input_disable" name="speciality">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Bed</label>
                                    <input type="text" class="form-control input_disable" name="bed">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>In Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_indoor_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Out Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_outdoor_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >ICU</label>
                                    <select class="form-control input_disable" name="icu">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >NICU</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >CT Scan</label>
                                    <select class="form-control input_disable" name="ct_scan">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >MRI</label>
                                    <select class="form-control input_disable" name="mri">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >USG</label>
                                    <select class="form-control input_disable" name="usg">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="3" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Diagnostic Center Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Speciality</label>
                                    <input type="text" class="form-control input_disable" name="speciality">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>In Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_indoor_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >CT Scan</label>
                                    <select class="form-control input_disable" name="ct_scan">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >MRI</label>
                                    <select class="form-control input_disable" name="mri">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >USG</label>
                                    <select class="form-control input_disable" name="usg">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="4" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Nursing Home Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Speciality</label>
                                    <input type="text" class="form-control input_disable" name="speciality">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Bed</label>
                                    <input type="text" class="form-control input_disable" name="bed">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>In Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="in_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Out Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="out_patient">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >ICU</label>
                                    <select class="form-control input_disable" name="icu">
                                        <option value="0">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >NICU</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="0">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >CT Scan</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="0">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >MRI</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="0">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >USG</label>
                                    <select class="form-control input_disable" name="nicu">
                                        <option value="0">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div id="5" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Doctor Chamber Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required >
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Speciality</label>
                                    <input type="text" class="form-control input_disable" name="speciality">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Out Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="out_patient">
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label >USG</label>
                                    <select class="form-control input_disable" name="usg">
                                        <option value="">Select Type</option>
                                        <option value="1">YES</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div id="6" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Pharmacy Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>In Patient/Day</label>
                                    <input type="text" class="form-control input_disable" name="daily_indoor_patient">
                                </div>
                            </div>
                        </div>

                        <div id="7" class="org_form">
                            <div class="row">
                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Organization Name</label>
                                    <input type="text" class="form-control input_disable" name="org_name" required>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Category</label>
                                    <input type="text" class="form-control" name="category">
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address" rquired>
                                </div>

                                <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Employee</label>
                                    <input type="text" class="form-control" name="employee">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-xs-12 col-lg-12 col-md-12 col-sm-12" align="center">
                            <input type="submit"  value="Register Franchise" class="btn btn-default register-btn" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">



            </div>
            {!! Form::close() !!}
        </div>
    </section>
    <script type="text/javascript">
        $(function() {
            $('.org_form').css('display','none');
            $('.org_form .input_disable').prop('disabled','true');
            $('#organizationselector').change(function(){
                $('.org_form').css('display','none');

                $('#' + $(this).val()).show();
                $('#' + $(this).val() ).find(':input').removeAttr("disabled");

            });
        });
        $(function() {
            $('select[name=district_id]').change(function() {
                var id = $(this).val();

                $('#thanaId').load('{{ URL::to('load-thana')}}/'+id);

            });
            $('select[name=division_id]').change(function() {
                var did = $(this).val();

                $('#districtId').load('{{ URL::to('load-district')}}/'+did);

            });

        });
        $(document).ready(function(){
         $("#license-image-select").change(function(){
            readURL1(this);
        });
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    
                    $('#license-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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

    });
    </script>


@endsection


