<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Franchise Register | Probe Bangladesh</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
{!!Html::style('public/custom/css/bootstrap.min.css')!!}
<!-- Font Awesome -->
{!!Html::style('public/custom/css_icon/font-awesome/css/font-awesome.min.css')!!}
<!-- Theme style -->
{!!Html::style('public/custom/css/AdminLTE.css')!!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
{!!Html::style('public/custom/css/skins/_all-skins.css')!!}
{!!Html::style('public/custom/css/style.css')!!}
{!!Html::style('public/custom/css/summernote.min.css')!!}
{!!Html::style('public/custom/css/jquery-ui.min.css')!!}
{!!Html::style('public/custom/css/bootstrap-toggle.min.css')!!}
{!!Html::style('public/custom/css/bootstrap-tagsinput.css')!!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
{!!Html::style('public/custom/css/fonts.css')!!}
<!-- jQuery 3 -->
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'><link href="https://fonts.googleapis.com/css?family=Dancing+Script|Pacifico|Yanone+Kaffeesatz&display=swap" rel="stylesheet">
{!!Html::script('public/custom/js/plugins/jquery/dist/jquery.min.js')!!}
{!!Html::script('public/js/jquery.validate.js')!!}

<!-- Bootstrap 3.3.7 -->
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap-confirmation.min.js')!!}
<!-- SlimScroll -->
{!!Html::script('public/custom/js/plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
<!-- FastClick -->
{!!Html::script('public/custom/js/plugins/fastclick/lib/fastclick.js')!!}
<!-- AdminLTE App -->
{!!Html::script('public/custom/js/adminlte.js')!!}
<!--datepicker-->
{!!Html::script('public/custom/js/plugins/datepicker/bootstrap-datepicker.js')!!}
{!!Html::style('public/custom/js/plugins/datepicker/datepicker3.css')!!}
    
<!-- AdminLTE for demo purposes -->
{!!Html::script('public/custom/js/demo.js')!!}
{!!Html::script('public/custom/js/jquery-ui.js')!!}
{!!Html::script('public/custom/js/summernote.min.js')!!}
{!!Html::script('public/custom/js/bootstrap-toggle.min.js')!!}
{!!Html::script('public/custom/js/bootstrap-tagsinput.js')!!}
{!!Html::script('public/custom/js/sweetalert.min.js')!!}
{!!Html::script('public/custom/js/notify.js')!!}
{!!Html::script('public/custom/js/jscolor.js')!!}
{!!Html::script('public/custom/js/plugins/chart/chart.js')!!}
<!-- select dropdown -->
{!!Html::style('public/custom/js/plugins/select/select2.min.css')!!}
{!!Html::script('public/custom/js/plugins/select/select2.min.js')!!}
{!!Html::script('public/js/money-format.js')!!}
{!!Html::script('public/js/ckeditor.js')!!}
{!!Html::script('public/js/jquery-barcode-scanner.js')!!}
{!!Html::script('public/js/radio-input.js')!!}

    <style type="text/css">
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
            rgba(0,0,0,0.55) url('./public/custom/img/diabetes-528678_1920.jpg') no-repeat center;
            background-size: cover;
        }
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
        .py-4{
            padding: 50px 30px;
            margin-top: 20px;
            margin-bottom: 30px;
            background-color: #fff;
            -moz-box-shadow: 0 2px 6px 4px #000;
            -webkit-box-shadow: 0 2px 6px 4px #000;
            box-shadow: 0 2px 6px 4px #000;
            border-radius: 5px;
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
    </style>

</head>
<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green">
    <div role="main" class="main">
        <section class="page-header-modern bg-color-dark page-header-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 order-2 order-md-1 align-self-center p-static">
                        <h1 class="franchise_header">Franchise Register<strong></strong></h1>
                    </div>
                    <div class="col-md-2 pull-right">
                        <a href="{{url('https://probebangladesh.com/')}}"><img src="{{asset('public/custom/img/home.png')}}" style="height: 80px;width: 100px;background-color: #ec2328;border-radius:50%"></a>
                    </div>
                </div>
            </div>
        </section>
        <div class="container py-4">
            @include('common.message')
            <div class="row mb-5">
                <div class="col">
                    <form id="contactForm"  action="{{ route('franchise.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label class="required font-weight-bold text-dark text-2">Franchise Contact Name</label>
                                <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">Mobile</label>
                                <input type="text" value="" data-msg-required="mobile number" class="form-control" name="mobile">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">Sex</label>
                                <select class="form-control" name="sex">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">DOB</label>
                                <input type="text" value="" data-msg-required="date of birth." maxlength="100" class="form-control wsit_datepicker" name="dob" id="dob">
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">Division</label>
                                <select name="division_id" class="form-control">
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $division)
                                       <option value="{{  $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">District</label>
                                <select name="district_id" id="districtId" class="form-control">
                                    <option value="">Select District</option>

                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="required font-weight-bold text-dark text-2">Thana</label>
                                <select class="form-control" name="thana_id" id="thanaId">
                                    <option value="">Select Thana</option>

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


                        <div class="form-row">
                            <div class="form-group col-lg-6" align="center">

                                <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                    <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="license-image" style="width: 100%;height: 100%">
                                </div>
                                <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                    Upload Trade License <input type="file" name="trade_license" class="form-control" id="license-image-select" style="display: none;">
                                </label>

                            </div>
                            <div class="form-group col-lg-6" align="center">

                                <div class="select_image" style="width: 100%; height: 300px; border:1px solid #ddd;">
                                    <img src='{{asset("storage/app/public/uploads/upload-doc.png")}}' id="card-image" style="width: 100%;height: 100%">
                                </div>
                                <label class="btn btn-success" style="width: 100%;margin-top: 5px;">
                                    Upload Business Card <input type="file" name="business_card" class="form-control" id="card-image-select" style="display: none;">
                                </label>

                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="required font-weight-bold text-dark text-2">Organization Type</label>
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control input_disable" name="speciality">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control input_disable" name="speciality">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control input_disable" name="speciality">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control input_disable" name="speciality">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
                                        <select class="form-control input_disable" name="nicu">
                                            <option value="">Select Type</option>
                                            <option value="1">YES</option>
                                            <option value="2">NO</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label >MRI</label>
                                        <select class="form-control input_disable" name="nicu">
                                            <option value="">Select Type</option>
                                            <option value="1">YES</option>
                                            <option value="2">NO</option>
                                        </select>
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label >USG</label>
                                        <select class="form-control input_disable" name="nicu">
                                            <option value="">Select Type</option>
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
                                        <input type="text" class="form-control input_disable" name="org_name" >
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Speciality</label>
                                        <input type="text" class="form-control input_disable" name="speciality">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                    <label>Address</label>
                                    <input type="text" class="form-control input_disable" name="org_address">
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
                                        <input type="text" class="form-control input_disable" name="org_name">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Category</label>
                                        <input type="text" class="form-control" name="category">
                                    </div>

                                    <div class="col-xs-4 col-lg-4 col-md-4">
                                        <label>Address</label>
                                        <input type="text" class="form-control input_disable" name="org_address">
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
            </div>
        </div>
        <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->

    </div>
    {!!Html::script('public/custom/js/ams.js')!!}



</body>

<script type="text/javascript">
    $(function() {
        $('.org_form').css('display','none');
        $('.org_form .input_disable').prop('disabled','true');
        $('#organizationselector').change(function(){
            $('.org_form').css('display','none');

            $('#' + $(this).val()).show();
            $('#' + $(this).val() ).find(':input').removeAttr("disabled");

            console.log($('#' + $(this).val() ).find(':input'));
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
</html>
