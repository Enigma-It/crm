<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>@yield('title')</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap 3.3.7 -->
{!!Html::style('public/custom/css/bootstrap.min.css')!!}
<!-- Font Awesome -->
{!!Html::style('public/custom/css_icon/font-awesome/css/font-awesome.min.css')!!}
{!!Html::style('public/custom/css/fontawesome-5.min.css')!!}
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
<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville&display=swap" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
{!!Html::style('public/custom/css/fonts.css')!!}
<!-- jQuery 3 -->
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
 
 <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

</head>
<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green">
<?php 
  $uri = Request::path(); 
  if(!empty(Auth::user()->image)){
    $profImg = "storage/app/public/uploads/users/".Auth::user()->image;
  }else{
    $profImg = "storage/app/public/uploads/person.jpg";
  }

  use App\Library\pmscommon;
  
  $config_layout = pmscommon::userWiseAccessSelection('add_edit', 'ConfigurationSetting');
  $employeelist_layout = pmscommon::userWiseAccessSelection('', 'EmployeeController');
  $employeeEntry_layout = pmscommon::userWiseAccessSelection('add_edit', 'EmployeeController');
  $salarylist_layout = pmscommon::userWiseAccessSelection('', 'EmployeeSalaryController');
  $salaryEntry_layout = pmscommon::userWiseAccessSelection('add_edit', 'EmployeeSalaryController');
  $userTypelist_layout = pmscommon::userWiseAccessSelection('', 'UserTypeController');
  $designation_layout = pmscommon::userWiseAccessSelection('', 'EmployeeDesignationController');
  $Franchise_layout = pmscommon::userWiseAccessSelection('', 'AgentFranchiseController');
  $Division_layout = pmscommon::userWiseAccessSelection('', 'DivisionController');
  $District_layout = pmscommon::userWiseAccessSelection('', 'DistrictController');
  $Thana_layout = pmscommon::userWiseAccessSelection('', 'ThanaController');
  $Doctor_layout = pmscommon::userWiseAccessSelection('', 'DoctorController');
  $MedicalDepartment_layout = pmscommon::userWiseAccessSelection('', 'MedicalDepartmentController');
  $DoctorAppointment_layout = pmscommon::userWiseAccessSelection('', 'DoctorAppointment');
  $BloodGroup_layout = pmscommon::userWiseAccessSelection('', 'BloodGroupController');
  $DiagnosticPatientDuePay_layout = pmscommon::userWiseAccessSelection('add_edit','DiagnosticPatientDuePayController');
  $DiagnosticCenter_layout = pmscommon::userWiseAccessSelection('', 'DiagnosticController');
  $DiagnosticReportStatusChange_layout = pmscommon::userWiseAccessSelection('add_edit', 'DiagnosticTestStatusCheckController');
  $Test_Dept_layout = pmscommon::userWiseAccessSelection('', 'TestDepartmentController');
  $Test_layout = pmscommon::userWiseAccessSelection('', 'PathologyTestController');
  $Deposit_layout = pmscommon::userWiseAccessSelection('', 'FranchiseDepositController');
  $services_layout = pmscommon::userWiseAccessSelection('', 'ServiceController');
  $package_layout = pmscommon::userWiseAccessSelection('', 'PackageController');
  $event_layout = pmscommon::userWiseAccessSelection('', 'EventController');
  $blog_layout = pmscommon::userWiseAccessSelection('', 'BlogController');
  $story_layout = pmscommon::userWiseAccessSelection('', 'StoryController');
  $healthtips_layout = pmscommon::userWiseAccessSelection('', 'HealthTipsController');
  $assignDeliveryMan_layout = pmscommon::userWiseAccessSelection('', 'FranchiseAssignToDeliveryManController');
  $sample_collection_layout = pmscommon::userWiseAccessSelection('', 'SampleCollectionController');
  $sample_collection_update_layout = pmscommon::userWiseAccessSelection('', 'SampleCollectionUpdateController');
  $agent_management_layout = pmscommon::userWiseAccessSelection('','AgentManagementController');
  $package_sell_layout = pmscommon::userWiseAccessSelection('','AgentPackageSellController');
  $area_layout = pmscommon::userWiseAccessSelection('','AreaController');
  $logistic_layout = pmscommon::userWiseAccessSelection('','LogisticController');
  $courier_sample_layout = pmscommon::userWiseAccessSelection('','CourierSampleCollectionController');
  $empty_box_collection = pmscommon::userWiseAccessSelection('','CentralLabController');
?>
<style type="text/css">
  .notification-section{
    width: auto !important;
  }
  .notification-section li.danger{
    background-color: #f5c6cb;
  }
  .notification-section li.danger a{
    color: #721c24!important; 
  }
  .notification-section li.warning{
    background-color: #ffeeba;
  }
  .notification-section li.warning a{
    color: #856404!important;
  }
  .ui-menu .ui-menu-item a {
    font-size: 12px;
  }
  .ui-autocomplete {
    position: fixed;
    top: 100%;
    left: 0;
    z-index: 1051 !important;
    float: left;
    display: none;
    min-width: 160px;
    width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
  }
</style>
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{URL::To('dashboard')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><i class="fa fa-dashboard fa-2x" aria-hidden="true"></i></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <!-- <img style="width: 100%;" src="{{asset("storage/app/public/uploads/pharmacare.png")}}"> -->
      <img style=" margin-top:4px;" src="{{asset("public/custom/img/prob.png")}}" height="50px" width="150px">
    </span> 
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!!Html::image( asset($profImg), 'User Image', array('class' => 'user-image'))!!}<span class="hidden-xs">{{Auth::user()->name}}</span> </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">{!!Html::image( asset($profImg), 'User Image', array('class' => 'img-circle'))!!}
                <p>Hello<br/>
                  <small>{{Auth::user()->name}}</small><small></small></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                @if(Auth::user()->id==1)
                <div style="margin-bottom:10px" align="center"> <a href="{{URL::To('manage-admin')}}" class="btn btn-warning" style="width:80%;">Manage Admin / Super Admin</a></div>
                @endif
                @if(Auth::User()->user_type =='' || Auth::User()->user_type ==1)
                <div class="pull-left"> <a href="javascript:;" data-toggle="modal" data-target="#profile_modal" class="btn btn-primary btn-flat">Profile</a> </div>
                @endif
                <div class="pull-right"> 
                  <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                    {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form> 
                </div>
              </li>
            </ul>
          </li>
          @if($config_layout==true)
          <!-- Control Sidebar Toggle Button -->
          <!-- <li> <a href="{{url('settings')}}"><i class="fa fa-gears"></i></a> </li> -->
          @endif
        </ul>
      </div>
    </nav>
  </header>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image"> {!!Html::image(asset($profImg), 'User Image', array('class' => 'img-circle'))!!}</div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{($uri=='dashboard')?'active':''}}"><a href="{{URL::To('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>

        @if($employeeEntry_layout==true || $employeelist_layout==true || $salaryEntry_layout==true || $salarylist_layout==true || $designation_layout==true)
        <li class="treeview {{($uri=='add-employee'||$uri=='employee-list')?'active':''}} {{($uri=='employee-salary-list'||$uri=='employee-salary-list/create' || $uri=='employee-designation')?'active':''}}"><a href="#"> <i class="fa fa-users"></i> <span>Manage Staffs/Employee</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            @if($employeeEntry_layout==true)
            <li class="{{($uri=='add-employee')?'active':''}}"><a href="{{url('add-employee')}}"><i class="fa fa-angle-double-right"></i>Add Staffs/Employee</a></li>
            @endif
            @if($employeelist_layout==true)
            <li class="{{($uri=='employee-list')?'active':''}}"><a href="{{url('employee-list')}}"><i class="fa fa-angle-double-right"></i>Staffs/Employee List</a></li>
            @endif
            @if($designation_layout==true)
            <li class="{{($uri=='employee-designation')?'active':''}}"><a href="{{url('employee-designation')}}"><i class="fa fa-angle-double-right"></i>Employee Designation</a></li>
            @endif
            
          </ul>
        </li>
        @endif

        @if($Franchise_layout ==true)
          <li class="treeview {{($uri=='agent-franchise/create' || $uri==='franchise-list' || $uri==='recharge-money')?'active':''}}"><a href="#"><i class="fa fa-user"></i><span>Franchise</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
              <li class="{{($uri=='agent-franchise/create')?'active':''}}"><a href="{{route('agent-franchise.create')}}"><i class="fa fa-angle-double-right"></i>Add Franchise</a></li>
              <li class="{{($uri==='franchise-list')?'active':''}}"><a href="{{url('franchise-list')}}"><i class="fa fa-angle-double-right"></i>Franchise List</a></li>
              <!-- <li class="{{($uri==='franchise-list')?'active':''}}"><a href="{{url('franchise-list')}}"><i class="fa fa-angle-double-right"></i>Sample Collection</a></li> -->
              @if($Deposit_layout == true)
              <li class="{{($uri==='recharge-money')?'active':''}}"><a href="{{url('recharge-money')}}"><i class="fa fa-angle-double-right"></i>Recharge Money</a></li>
              @endif
            </ul>
          </li>
        @endif
        @if($empty_box_collection==true)
          <li class="{{($uri==='empty-box-collection')?'active':''}}">
               <a href=" {{url('empty-box-collection')}}"><i class="fa fa-th-list" aria-hidden="true"></i><span>Lab</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          </li>
        @endif
          @if($Doctor_layout==true || $MedicalDepartment_layout==true)
          <li class="treeview {{($uri=='doctor' || $uri=='doctor/create' || $uri=='medical-department')?'active':''}}"> 
            <a href="#"> <i class="fa fa-stethoscope"></i> <span>Doctor </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
              @if($Doctor_layout==true)
              <li class="{{($uri=='doctor' || $uri=='doctor/create')?'active':''}}">
                <a href="{{URL::To('doctor')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Doctor List</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif
              <!-- @if($MedicalDepartment_layout==true)
              <li class="{{($uri=='medical-department')?'active':''}}">
                <a href="{{URL::To('medical-department')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Department</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif -->
            </ul>
          </li>
          @endif
          <!-- @if($DoctorAppointment_layout==true)
          <li class="{{($uri=='doctor-appointment' || $uri=='doctor-appointment/create')?'active':''}}"> 
            <a href="{{URL::To('doctor-appointment/create')}}"> <i class="fa fa-clock-o"></i> <span>Appointment </span> <span class="pull-right-container"></span> </a>
          </li>
          @endif -->
           <li class="{{($uri==='doctor-appoinment')?'active':''}}">
            <a href=" {{url('doctor-appoinment')}}"><i class="fa fa-clock-o"></i><span>Appointment List</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
         </li>


          <li class="{{($uri==='order-list')?'active':''}}">
            <a href=" {{url('order-list')}}"><i class="fa fa-th-list" aria-hidden="true"></i><span>Order List</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
         </li>


         @if($logistic_layout == true || $courier_sample_layout == true)
          <li class="treeview {{ ($uri==='logistic' || $uri==='courier-collection')?'active':'' }}"><a href="#"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><span>Logistic</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
               <ul class="treeview-menu">
                @if($logistic_layout == true)
                 <li class="{{($uri==='logistic')?'active':''}}"><a href="{{url('logistic')}}"><i class="fa fa-angle-double-right"></i>Courier</a></li>
                @endif
                @if($courier_sample_layout == true)
                 <li class="{{($uri==='courier-collection')?'active':''}}"><a href="{{url('courier-collection')}}"><i class="fa fa-angle-double-right"></i>Courier sample collection</a></li>
                 @endif
              </ul>
          </li>
        @endif




        <li class="treeview {{ ($uri==='news' || $uri==='all-news')? 'active' : '' }}"><a href="#"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><span>News</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
               <ul class="treeview-menu">
                 <li class="{{($uri==='news')?'active':''}}"><a href="{{url('news')}}"><i class="fa fa-angle-double-right"></i>Add/Edit News</a></li>

                 <li class="{{($uri==='all-news')?'active':''}}"><a href="{{url('all-news')}}"><i class="fa fa-angle-double-right"></i>All News List</a></li>

              </ul>
          </li>




        @if($DiagnosticPatientDuePay_layout ==true || $DiagnosticCenter_layout ==true || $DiagnosticReportStatusChange_layout ==true || $Test_Dept_layout ==true || $Test_layout ==true || $sample_collection_update_layout ==true)
          <li class="treeview {{($uri=='test-department' || $uri=='pathology-test' || $uri=='diagnostic' || $uri=='diagnostic/create' || $uri=='diagnostic-test-report-status' || $uri=='diagnostic-patient-due-pay' || $uri=='sample-status-update' )?'active':''}}"><a href="#"><i class="fa fa-flask"></i><span>Diagnostic Sample</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
              @if($DiagnosticCenter_layout ==true)
              <li class="{{($uri==='diagnostic/create')?'active':''}}"><a href="{{url('diagnostic/create')}}"><i class="fa fa-angle-double-right"></i>Test Collection</a></li>
             
               <li class="{{($uri==='diagnostic')?'active':''}}"><a href="{{url('diagnostic')}}"><i class="fa fa-angle-double-right"></i>Diagnostic List</a></li>
               @endif
               @if($DiagnosticReportStatusChange_layout ==true)
              <li class="{{($uri=='diagnostic-test-report-status')?'active':''}}">
                <a href="{{URL::To('diagnostic-test-report-status')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Diagnostic Report Status</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif
               @if($sample_collection_update_layout ==true)
                  <li class="{{($uri=='sample-status-update')?'active':''}}">
                   <a href="{{URL::To('sample-status-update')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Sample Collection Status</span> <span class="pull-right-container"> </span> </a> 
              </li>
               @endif
              @if($DiagnosticPatientDuePay_layout ==true)
              <li class="{{($uri=='diagnostic-patient-due-pay')?'active':''}}">
                <a href="{{URL::To('diagnostic-patient-due-pay')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Patient Due Pay</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif
              @if($Test_Dept_layout ==true)
              <li class="{{($uri=='test-department')?'active':''}}"><a href="{{URL::To('test-department')}}"><i class="fa fa-angle-double-right"></i>Test Department</a></li>
              @endif
              @if($Test_layout ==true)
              <li class="{{($uri=='pathology-test')?'active':''}}"><a href="{{URL::To('pathology-test')}}"><i class="fa fa-angle-double-right"></i>Pathology Test</a></li>
              @endif
            </ul>
          </li>
        @endif



         <li class="treeview {{($uri==='organization' || $uri==='health-package-test' || $uri==='health-package' || $uri==='health-package-list' || $uri==='health-package-sell')?'active':''}}"><a href="#"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><span>Health Card</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
               <ul class="treeview-menu">
                 <li class="{{($uri==='organization')?'active':''}}"><a href="{{url('organization')}}"><i class="fa fa-angle-double-right"></i>Organization</a></li>

                 <li class="{{($uri==='health-package-test')?'active':''}}"><a href="{{url('health-package-test')}}"><i class="fa fa-angle-double-right"></i>Health Package Price List</a></li>

                 <li class="{{($uri==='health-package')?'active':''}}"><a href="{{url('health-package')}}"><i class="fa fa-angle-double-right"></i>Health Package
                 </a></li>

                 <li class="{{($uri==='health-package-list')?'active':''}}"><a 
                  href="{{url('health-package-list')}}"><i class="fa fa-angle-double-right"></i>Health Package
                  List</a></li>

                  @if($package_sell_layout == true)
                  <li class="{{($uri==='health-package-sell')?'active':''}}"><a href="{{url('health-package-sell')}}"><i class="fa fa-angle-double-right"></i>Health Package
                  Sell</a></li>
                  @endif

                  <li class="{{($uri==='health-package-sell-list')?'active':''}}"><a href="{{url('health-package-sell-list')}}"><i class="fa fa-angle-double-right"></i>Health Card
                  Sell List</a></li>
                  
              </ul>
          </li>


          <li class="treeview {{($uri=='franchise-area-assign/create' || $uri==='diagnostic' || $uri=='diagnostic-test-report-status' || $uri=='diagnostic-patient-due-pay'|| $uri=='test-department' || $uri=='pathology-test')?'active':''}}"><a href="#"><i class="fa fa-flask"></i><span>Delivery Module</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
            <ul class="treeview-menu">
              @if($assignDeliveryMan_layout == true)
              <li class="{{($uri==='franchise-area-assign/create')?'active':''}}"><a href="{{url('franchise-area-assign/create')}}"><i class="fa fa-angle-double-right"></i>Assign Franchise</a></li>
             @endif
               <li class="{{($uri==='diagnostic')?'active':''}}"><a href="{{url('diagnostic')}}"><i class="fa fa-angle-double-right"></i>Diagnostic List</a></li>
               @if($DiagnosticReportStatusChange_layout ==true)
              <li class="{{($uri=='diagnostic-test-report-status')?'active':''}}">
                <a href="{{URL::To('diagnostic-test-report-status')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Diagnostic Report Status</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif
              @if($DiagnosticPatientDuePay_layout ==true)
              <li class="{{($uri=='diagnostic-patient-due-pay')?'active':''}}">
                <a href="{{URL::To('diagnostic-patient-due-pay')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Patient Due Pay</span> <span class="pull-right-container"> </span> </a> 
              </li>
              @endif
              @if($Test_Dept_layout ==true)
              <li class="{{($uri=='test-department')?'active':''}}"><a href="{{URL::To('test-department')}}"><i class="fa fa-angle-double-right"></i>Test Department</a></li>
              @endif
              @if($Test_layout ==true)
              <li class="{{($uri=='pathology-test')?'active':''}}"><a href="{{URL::To('pathology-test')}}"><i class="fa fa-angle-double-right"></i>Pathology Test</a></li>
              @endif
            </ul>
        </li>

        @if($sample_collection_layout==true)
         <li class="treeview {{($uri=='sample-collection' || $uri==='sample-collection-list')?'active':''}}"><a href="#"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i><span>Sample Collection</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
               <ul class="treeview-menu">
                 <li class="{{($uri==='sample-collection')?'active':''}}"><a href="{{url('sample-collection')}}"><i class="fa fa-angle-double-right"></i>Franchise List</a></li>

                 <li class="{{($uri==='sample-collection-list')?'active':''}}"><a href="{{url('sample-collection-list')}}"><i class="fa fa-angle-double-right"></i>Collection List</a></li>

              </ul>
          </li>
       @endif

       @if($agent_management_layout==true)
         <li class="treeview {{($uri=='agent-management')?'active':''}}"><a href="#"><i class="fa fa-user-secret"></i><span>Agent Management</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span></a>
               <ul class="treeview-menu">
                 <li class="{{($uri==='agent-management')?'active':''}}"><a href="{{url('agent-management')}}"><i class="fa fa-angle-double-right"></i>Agent Commision</a></li>
              </ul>
          </li>
       @endif
        <li class="treeview {{($uri=='add-service' || $uri==='all-service' || $uri==='add-package' || $uri==='all-package' || $uri==='booking_package' || $uri=='add-event' || $uri==='all_event' || $uri==='add-blog' || $uri==='all_blog' || $uri==='add-story' || $uri==='all_story')?'active':''}}"><a href="#"><i class="fa fa-globe"></i><span>Web Module</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">

            <li class="treeview {{($uri=='add-service' || $uri==='all-service')?'active':''}}"><a href="#"><i class="fa fa-cogs"></i><span>Service</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri=='add-service')?'active':''}}">
                    <a href="{{ route('service') }}"><i class="fa fa-angle-double-right"></i>Add Service</a>
                </li>
                <li class="{{($uri==='all-service')?'active':''}}">
                    <a href="{{ route('all_service') }}"><i class="fa fa-angle-double-right"></i>All service</a>
                </li>

              </ul>
            </li>
            <li class="treeview {{($uri==='add-package' || $uri==='all-package' || $uri==='booking_package')?'active':''}}"><a href="#"><i class="fa fa-cog"></i><span>Packages</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri==='add-package')?'active':''}}">
                    <a href="{{ route('package') }}"><i class="fa fa-angle-double-right"></i>Add Packages</a>
                </li>
                <li class="{{($uri==='all-package')?'active':''}}">
                    <a href="{{ route('all_package') }}"><i class="fa fa-angle-double-right"></i>All Packages</a>
                </li>
                <li class="{{($uri==='booking_package')?'active':''}}">
                    <a href="{{ route('booking_package') }}"><i class="fa fa-angle-double-right"></i>Packages Booking List</a>
                </li>
              </ul>
            </li>
            <li class="treeview {{($uri==='add-event' || $uri==='all_event')?'active':''}}"><a href="#"><i class="fa fa-calendar-o"></i><span>Event</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri==='add-event')?'active':''}}">
                    <a href="{{ route('event') }}"><i class="fa fa-angle-double-right"></i>Add Event</a>
                </li>
                <li class="{{($uri==='all_event')?'active':''}}">
                    <a href="{{ route('all_event') }}"><i class="fa fa-angle-double-right"></i>All Event</a>
                </li>

              </ul>
            </li>

             <li class="treeview {{($uri==='add-blog' || $uri==='all_blog')?'active':''}}"><a href="#"><i class="fa fa-rss"></i><span>Blogs</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri==='add-blog')?'active':''}}">
                    <a href="{{ route('blog') }}"><i class="fa fa-angle-double-right"></i>Add Blogs</a>
                </li>
                <li class="{{($uri==='all_blog')?'active':''}}">
                    <a href="{{ route('all_blog') }}"><i class="fa fa-angle-double-right"></i>All Blogs</a>
                </li>

              </ul>
            </li>

             <li class="treeview {{($uri==='add-story' || $uri==='all_story')?'active':''}}"><a href="#"><i class="fa fa-hand-peace-o"></i><span>Success Story</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri==='add-story')?'active':''}}">
                    <a href="{{ route('story') }}"><i class="fa fa-angle-double-right"></i>Add Story</a>
                </li>
                <li class="{{($uri==='all_story')?'active':''}}">
                    <a href="{{ route('all_story') }}"><i class="fa fa-angle-double-right"></i>All Story</a>
                </li>
              </ul>
            </li>
            <li class="treeview {{($uri==='health/create' || $uri==='health')?'active':''}}"><a href="#"><i class="fa fa-hand-peace-o"></i><span>Health Tips</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li class="{{($uri==='health/create')?'active':''}}">
                    <a href="{{ route('health.create') }}"><i class="fa fa-angle-double-right"></i>Add Health Tips</a>
                </li>
                <li class="{{($uri==='health')?'active':''}}">
                    <a href="{{ url('health') }}"><i class="fa fa-angle-double-right"></i>All Health Tips</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        @if($userTypelist_layout==true || $Division_layout ==true || $District_layout ==true || $Thana_layout ==true || $BloodGroup_layout==true)
        <li class="treeview {{($uri=='user-type' || $uri==='division' || $uri=='district' || $uri=='thana'|| $uri=='currency' || $uri=='employee-designation' || $uri=='blood-group')?'active':''}}"> <a href="#"> <i class="fa fa-th"></i> <span>Master Module</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            @if($area_layout==true)
                <li class="{{($uri=='area')?'active':''}}"><a href="{{URL::To('area')}}"><i class="fa fa-angle-double-right"></i>Area</a></li>
            @endif
            @if($userTypelist_layout==true)
            <li class="{{($uri=='user-type')?'active':''}}"><a href="{{URL::To('user-type')}}"><i class="fa fa-angle-double-right"></i> User Type</a></li>
            @endif
 
            @if($Division_layout ==true)
            <li class="{{($uri=='division')?'active':''}}"><a href="{{URL::To('division')}}"><i class="fa fa-angle-double-right"></i> Division</a></li>
            @endif
            @if($District_layout ==true)
            <li class="{{($uri=='district')?'active':''}}"><a href="{{URL::To('district')}}"><i class="fa fa-angle-double-right"></i>District</a></li>
            @endif
            @if($Thana_layout ==true)
            <li class="{{($uri=='thana')?'active':''}}"><a href="{{URL::To('thana')}}"><i class="fa fa-angle-double-right"></i>Thana</a></li>
            @endif
             @if($BloodGroup_layout==true)
            <li class="{{($uri=='blood-group')?'active':''}}">
              <a href="{{URL::To('blood-group')}}"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> <span>Blood Group</span> <span class="pull-right-container"> </span> </a> 
            </li>
            @endif
          </ul>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">@include('sweet::alert') @yield('content') </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer"> 
    <strong>Copyright &copy; {{date('Y')}} <a target="_blank" href="#">Probe Bangladesh Ltd</a>.</strong> All rights
    reserved.
     <div class="pull-right hidden-xs"> <b>Develop By</b> <a href="#">Enigma IT Solutions</a> </div> 
  </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-birthday-cake bg-red"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
              <p>Will be 23 on April 24th</p>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-user bg-yellow"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
              <p>New phone +1(800)555-1234</p>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
              <p>nora@example.com</p>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-file-code-o bg-green"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
              <p>Execution time 5 seconds</p>
            </div>
            </a> 
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Custom Template Design <span class="label label-danger pull-right">70%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Update Resume <span class="label label-success pull-right">95%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Laravel Integration <span class="label label-warning pull-right">50%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
            </a> 
          </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Back End Framework <span class="label label-primary pull-right">68%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
            </a> 
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Report panel usage
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Some information about this general settings option </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Other sets of options are available </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Allow the user to show his name in blog posts </p>
          </div>
          <!-- /.form-group -->
          <h3 class="control-sidebar-heading">Chat Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Show me as online
            <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Turn off notifications
            <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Delete chat history <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a> </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 450px; margin: 0 auto;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Profile Information</h4>
      </div>
      <div class="modal-body">
        <h4 align="center" id="notifyMsg"></h4>
        {{Form::hidden('id',Auth::user()->id)}}
        <div class="form-group row">
          {{Form::label('name', 'Name:', array('class' => 'col-md-4 control-label'))}}
          <div class="col-md-8">
              <input type="text" class="form-control" id="name" value="{{  Auth::user()->name  }}" name="name" placeholder="Name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSave" value="add">Update</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('#confirmPass').on('keyup', function () {
      $('#confirmMsg').html('');
      if ($('#newPass').val() == $('#confirmPass').val()) {
        $('#confirmMsg').html('Password Matched !').css('color', 'green');
        //$('.submit_btn').removeAttr("disabled");
      } else 
        //$('.submit_btn').attr('disabled','true');
        $('#confirmMsg').html('Password Do not Matched !').css('color', 'red');
    });
    $('#newPass').on('keyup', function () {
      $('#confirmMsg').html('');
      if ($('#newPass').val() == $('#confirmPass').val()) {
        $('#confirmMsg').html('Password Matched !').css('color', 'green');
      } else
        $('#confirmMsg').html('Password Do not Matched !').css('color', 'red');

    });
    $('#btnSave').on('click',function(){
        if ($('#newPass').val() == $('#confirmPass').val()){
          $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            method: "POST",
            url: "{{URL::to('update-profile')}}",
            data: {
              'id': $('input[name=id]').val(),
              'name': $('input[name=name]').val(),
              'exist_password': $('input[name=exist_password]').val(),
              'old_password': $('input[name=old_password]').val(),
              'password': $('input[name=password]').val(),
              'confirm_password': $('input[name=confirm_password]').val(),
            },
            dataType: "json",
            success: function(data){
              $('#notifyMsg').html(data[0]).css('color',data[1]);

              $('#notifyMsg').delay(500).fadeIn('normal', function() {
                $(this).delay(2000).fadeOut();
             });
            },
            error: function(data){
            }
          });
        }else{
          $('#confirmMsg').html('Password Do not Matched!!').css('color', 'red');
          return false;
        }
  });
</script>
{!!Html::script('public/custom/js/ams.js')!!}
</body>
</html>
