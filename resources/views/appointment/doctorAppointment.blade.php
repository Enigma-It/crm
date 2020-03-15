@extends('layouts.layout')
@section('title', 'New Appointment')
@section('content')
<?php  
  use App\Library\memberShipLib;
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
?>
<style type="text/css">
.date-day{
  height: 65px; 
  width: 100px; 
  text-align: center;
  background-color: #f3f3e0;
  border: 1px solid #e4e4d0 !important;
  font-weight: bold;
}
.actionBtn{
  display: none;
  margin: 8px;
  text-align: center;
}
.actionBtn a{
  color: #0000008c;
}
.slot{
  min-width: 130px;
  padding:5px; 
  border: 1px solid #bfb6b6; 
  color: #000; 
  font-size:12px; 
  vertical-align: top;
}
.disable-slot{
  background-color:#ffe4b9;
}
.disable-slot:hover{
  cursor: not-allowed;
}
.view-user-status{
  width: 65px;
  float: right;
  text-align: right;
}
.label-slot{
  float: right;
  font-size: 13px;
}
.slot:hover .actionBtn{
    display: block;
}
.display_hide{
  display: none;
}
.display_block{
  display: block;
}
</style>

<section class="content-header">
  <h1><i class="fa fa-clock-o"></i> New Appointment</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">New Appointment</li>
  </ol>
</section>
<section class="content">
  @include('common.message')
  @include('common.commonFunction')
  <div class="box box-success">
    <div class="box-header with-border">
      <div class="col-md-4 pull-right" align="right">
        <!-- <a href="{{URL::to('doctor-appointment/create')}}" class="btn btn-warning">
          <i class="fa fa-refresh"></i> <b>Refresh</b>
        </a> -->
        <a href="{{Request::url()}}" class="btn btn-warning">
          <i class="fa fa-refresh"></i> <b>Refresh</b>
        </a> 
      </div>
      <div class="col-md-8" style="padding-left: 0px; padding-right: 0px;">
        {!! Form::open(array('url' => 'load-apponitment-schedule','class'=>'form-horizontal','method' =>'GET','files'=>true)) !!}
          <div class="col-md-6">
            <select class="form-control" name="doctor_id" id="doctor_id">
              <option value="">-- Select A Doctor --</option>
              @foreach($doctorList as $doctorData)
              <option value="{{$doctorData->id}}" {{(isset($selectedDoctor))?($selectedDoctor==$doctorData->id)?'selected':'':''}}>
                {{$doctorData->first_name.' '.$doctorData->last_name}} ({{$doctorData->department_name}})
              </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <button type="submit" name="" class="btn btn-success" style="width: 100%">Load Schedule</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

    <div class="box-body">
      <div class="table_scroll">
        @if(isset($startDate))
          <?php $startDate = $startDate; ?>
        @else
          @if(date('l',strtotime('Today'))=="Saturday")
            <?php $startDate = date('m/d/Y',strtotime('Today')); ?>
          @else
            <?php $startDate = date('m/d/Y',strtotime('last Saturday')); ?>
          @endif
        @endif

        <?php 
          $endDate = date('m/d/Y', strtotime('+6 day', strtotime($startDate)));
          $selectedDays = array();
          if(isset($singelDoctorData->appointment_day_slot_schedule)){
            $doctorScheduleData = json_decode($singelDoctorData->appointment_day_slot_schedule, true);
            if(!empty($doctorScheduleData)){
              foreach($doctorScheduleData as $key=>$data){
                $selectedDays[$key] = weeks()[$key];
                $selectedDayData[weeks()[$key]] = $data;
              }
            }
          }
        ?>

        @if(!empty($selectedDays))
        <?php $slotId = 1; ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr style="background-color: #00000045; font-size: 16px;">
              <td style="width: 100px; text-align: center">
                Date / Day
              </td>
              <td>Time</td>
            </tr>
          <?php $initialDate = $startDate; ?>
          @while ( $initialDate <= $endDate ) 
            @if(in_array(date('l',strtotime($initialDate)), $selectedDays))
              <tr>
                <td class="date-day">
                  {{$initialDate}}
                  <br>
                  {{date('l',strtotime($initialDate))}}
                </td>
                <td style="padding: 2px 4px;">
                  <table style="width: 100%;">
                    <tr style="height: 75px;">
                      <?php  
                        $slotsArr=json_decode($selectedDayData[date('l',strtotime($initialDate))], true);
                      ?>
                      @foreach($slotsArr as $slotsArrKey=>$slotsArrData)
                        <?php  
                          $existedCheck = pmscommon::DoctorAppointmentBookingCheck($initialDate, $slotsArrKey, $selectedDoctor);
                          $bookingData  = $existedCheck['bookingData'];
                          $bookingStatus=0;
                        ?>

                        @if(isset($bookingData['status']))
                          <?php $bookingStatus = $bookingData['status'];?>
                        @endif

                        <td class="slot slotNo_{{$slotId}} {{($bookingStatus==2)?'disable-slot':''}}">
                          {{date('h:i A', strtotime($slotsArrKey))}}
                          <div class="form-inline view-user-status">
                            <div class="input-group">
                             <div class="view-person viewUser_{{$slotId}}">
                              @if($bookingStatus==1)
                               <a href="#" onclick="showModal('{{$slotId}}', 'viewBooking')" class="fa fa-user" title="View User Info"></a>
                              @endif
                             </div>
                            </div>
                            &nbsp;
                            <div class="input-group">
                              <div class="label-slot statusLabel_{{$slotId}}">
                                @if($bookingStatus==1)
                                <label class="label label-danger" style="padding:1px 3px;">Booked</label>
                                @endif
                              </div>
                            </div>
                         </div>
                         <div class="form-inline actionBtn">
                          @if($add_edit==true && $delete==true)
                            <div class="input-group">
                              <div class="addEditBtn_{{$slotId}}">
                                @if($bookingStatus==0)
                                <a href="#" onclick="showModal('{{$slotId}}', 'newBooking')" title="Add Booking"><i class="fa fa-plus"></i></a>
                                @elseif($bookingStatus==1)
                                <a href="#" onclick="showModal('{{$slotId}}', 'editBooking')" title="Edit Booking"><i class="fa fa-pencil"></i></a>
                                @endif
                              </div>
                            </div>
                            &nbsp;
                            <div class="input-group deleteBtn_{{$slotId}}">
                             @if($bookingStatus==1 || $bookingStatus==0)
                             <a href="#" onclick="showModal('{{$slotId}}', 'deleteBooking')" title="Delete Booking"><i class="fa fa-times"></i></a>
                             @endif
                            </div>
                          @endif
                         </div>

                         <div class="input-slots">
                            <input type="hidden" id="date_{{$slotId}}" value="{{$initialDate}}">
                            <input type="hidden" id="time_{{$slotId}}" value="{{$slotsArrKey}}">
                            <input type="hidden" id="bookingId_{{$slotId}}" value="{{$existedCheck['booking_id']}}">
                         </div>
                        </td>
                        <?php $slotId++; ?>
                      @endforeach
                    </tr>
                  </table>
                </td>
              </tr>
            @endif
            <?php  $initialDate = date('m/d/Y', strtotime('+1 day', strtotime($initialDate))); ?>
          @endwhile
          </table>
        </div>

        <div class="col-md-12">
          <div class="col-md-2 col-md-offset-5" style="margin-top: 15px;">
            <div class="form-inline">
              <div class="input-group">
                <?php $newStartDate = date('m/d/Y', strtotime('-7 day', strtotime($startDate))); ?>
                <a href="{{URL::To('load-apponitment-schedule?doctor_id=')}}{{$selectedDoctor}}&date={{$newStartDate}}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-left"></i></a>
              </div>
              <div class="input-group">
                <a href="{{URL::To('load-apponitment-schedule?doctor_id=')}}{{$selectedDoctor}}" class="btn btn-xs btn-primary">Current Week</a>
              </div>
              <div class="input-group">
                <?php $newStartDate = date('m/d/Y', strtotime('+1 day', strtotime($endDate))); ?>
                <a href="{{URL::To('load-apponitment-schedule?doctor_id=')}}{{$selectedDoctor}}&date={{$newStartDate}}" class="btn btn-xs btn-primary"><i class="fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="box-footer"> </div>
  </div>
</section>
  
  <div class="modal fade" id="viewBookingModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> <i class="fa fa-info-circle"></i> Booking Information</h4>
        </div>
        <div class="modal-body clearfix">
          <table class="table table-bordered table-responsive">
            <tr><td>Name</td><td id="viewName"></td></tr>
            <tr><td>Contact</td><td id="viewNumber"></td></tr>
            <tr><td>Visit</td><td id="viewVisit"></td></tr>
            <tr><td>Date</td><td id="viewDate"></td></tr>
            <tr><td>Time</td><td id="viewTime"></td></tr>
            <tr><td>Status</td><td id="viewStatus"></td></tr>
          </table> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"> <i class="fa fa-plus-square"></i> Appointment Booking Form</h4>
        </div>
        <div class="modal-body clearfix">
          <div class="form-group">
              <div class="col-md-12">
                <label for="patient_name">Patient Name: </label>
                <input type="text" class="form-control" value="" id="patient_name" name="patient_name" placeholder="Patient Name" required>
              </div>
          </div>  
          <div class="form-group">
              <div class="col-md-12">
                <label for="patient_number">Patient Number: </label>
                <input type="text" class="form-control" value="" id="patient_number" name="patient_number" placeholder="Patient Number" required>
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-12">
                <label for="booking_status">Status: </label>
                {!!Form::select('booking_status', array(1 => 'Booked', 2 => 'Complete', 3 => 'Cancel'), 1, ['class'=>'form-control', 'id'=>'booking_status'])!!}
              </div>
          </div> 
          <div class="form-group visit_payment_section display_hide">
              <div class="col-md-12">
                <label for="visit_payment">Visit Payment: </label>
                <input type="text" class="form-control" value="" id="visit_payment" name="visit_payment" placeholder="Visit Payment">
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="form-group">
            <div class="col-md-12">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="submitForm" onclick="SaveUpdateViewData()">Save</button>
            </div>
          </div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<script type="text/javascript">
  function showModal($slotId, $action)
  {
    $("#submitForm").removeAttr('onclick');
    $("#patient_name").val('');
    $("#patient_number").val('');
    $("#visit_payment").val('');
    $("#booking_status").val(1);

    if($action=='newBooking'){
      $("#addEditModal").modal();
      $("#submitForm").attr("onclick","SaveUpdateViewData("+$slotId+",'"+$action+"')");
      $(".visit_payment_section").removeClass('display_block').addClass('display_hide');
    }

    if($action=='editBooking'){
      $("#addEditModal").modal();
      $("#submitForm").attr("onclick","SaveUpdateViewData("+$slotId+",'"+$action+"')");
      SaveUpdateViewData($slotId, 'getBookingData');
      $(".visit_payment_section").removeClass('display_hide').addClass('display_block');
    }

    if($action=='deleteBooking'){
      SaveUpdateViewData($slotId, $action);
    }

    if($action=='viewBooking'){
      $("#viewBookingModal").modal();
      SaveUpdateViewData($slotId, 'viewBooking');
    }
  }

  function SaveUpdateViewData($slotId, $action)
  {
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      method: "POST",
      url: "{{URL::to('save-update-view-booking')}}",
      data: {
        'patient_name': $("#patient_name").val(),
        'patient_number': $("#patient_number").val(),
        'booking_status': $("#booking_status").val(),
        'date': $("#date_"+$slotId).val(),
        'time': $("#time_"+$slotId).val(),
        'bookingId': $("#bookingId_"+$slotId).val(),
        'doctor_id': $("#doctor_id").val(),
        'visit_payment': ($action=='editBooking')?$("#visit_payment").val():'',
        'action': $action,
      },
      dataType: "json",
      success: function(data){
        if(data.result==true){
          fncResponse($slotId, $action, data.details);
        }else{
          alert(data.msg);
        }
      },
      error: function(data){
      }
    });

  }

  function fncResponse($slotId, $action, $data)
  {
    if($action=="newBooking"){
      $("#addEditModal").modal('hide');
      $(".viewUser_"+$slotId).html('<a href="" class="fa fa-user" onclick="showModal(\''+$slotId+'\', \'viewBooking\')" title="View User Info"></a>');
      $(".statusLabel_"+$slotId).html('<label class="label label-danger" style="padding:1px 3px;">Booked</label>');
      $(".addEditBtn_"+$slotId).html('<a href="#" onclick="showModal(\''+$slotId+'\', \'editBooking\')" title="Edit Booking"><i class="fa fa-pencil"></i></a>');
      $("#bookingId_"+$slotId).val($data.id);
    }

    if($action=="getBookingData"){
      $("#patient_name").val($data.name);
      $("#patient_number").val($data.contact_number);
      $("#booking_status").val($data.status);
      $("#visit_payment").val($data.visit_payment);
    }

    if($action=="editBooking"){
      $("#addEditModal").modal('hide');
      if($data.status==2){
        $(".viewUser_"+$slotId).html('');
        $(".statusLabel_"+$slotId).html('');
        $(".addEditBtn_"+$slotId).html('');
        $(".deleteBtn_"+$slotId).html('');
        $(".slotNo_"+$slotId).addClass('disable-slot');
      }
      if($data.status==3){
        $(".viewUser_"+$slotId).html('');
        $(".statusLabel_"+$slotId).html('');
        $(".addEditBtn_"+$slotId).html('<a href="#" onclick="showModal(\''+$slotId+'\', \'newBooking\')" title="Add Booking"><i class="fa fa-plus"></i></a>');
        $("#bookingId_"+$slotId).val('');
      }
    }

    if($action=="deleteBooking"){
      $(".viewUser_"+$slotId).html('');
      $(".statusLabel_"+$slotId).html('');
      $(".addEditBtn_"+$slotId).html('<a href="#" onclick="showModal(\''+$slotId+'\', \'newBooking\')" title="Add Booking"><i class="fa fa-plus"></i></a>');
      $("#bookingId_"+$slotId).val('');
    }

    if($action=="viewBooking"){
      $("#viewName").html($data.name);
      $("#viewNumber").html($data.contact_number);
      $("#viewVisit").html($data.visit_payment);
      $("#viewDate").html($data.date);
      $("#viewTime").html($data.time);
      $("#viewStatus").html($data.status);
    }
  }


</script>
@endsection 