@extends('layouts.layout')
@section('title', 'Diagnostic List')
@section('content')
<?php  
  use App\Library\pmscommon;
  use App\Library\memberShipLib;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
  $delete = pmscommon::userWiseAccessSelection('delete');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-stethoscope"></i> Diagnostic List</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="{{URL::to('diagnostic')}}">Diagnostic</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  @include('common.message')
  <div class="box box-success">
    <div class="box-header with-border" align="right">
      @if($add_edit==true)
      <a href="{{  url('diagnostic/create')  }}" class="btn btn-success"><i class="fa fa-plus"></i> <b>Diagnostic Entry</b></a> 
      @endif
      <a href="{{ url('diagnostic') }}" class="btn btn-warning"><i class="fa fa-refresh"></i> <b>Refresh</b></a> 
    </div>

    <div class="box-body">
      <div class="form-group">
        <div class="row col-md-3 pull-right">
          {!! Form::open(array('url' => 'diagnostic-search','class'=>'form-horizontal','method' =>'GET','files'=>true)) !!}
          @if(isset($autocomplete))
          <input name="patient_id" value="{{$autocomplete}}" class="form-control" placeholder="Search by Patient ID . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
          @else
          <input name="patient_id" value="" class="form-control" placeholder="Search by Patient ID . . ." type="text" selected style="border-radius: 25px;font-style: italic;">
          @endif
         {!! Form::close() !!}
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hovered table-responsive">
              <th>S/L</th>
              <th>Patient Name</th>
              <th>Patient ID</th>
              <th>Phone</th>
              <th>Total Amount</th>
              <th>Discount Amount</th>
              <th>Payable</th>
              <th>Received</th>
              <th>Due</th>
              <th align="center">Action</th>
               <?php                           
                  $number = 1;
                  $numElementsPerPage = 10; // How many elements per page
                  $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                  $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
                ?>
              @if(!empty(json_decode(json_encode($patientList), true)))
              <tbody>
                @foreach($patientList as $patient)
                <tr>
                  <td style="font-weight: bold;">{{$currentNumber++}}</td>
                  <td>{{$patient->patient_name}}</td>
                  <td><b>{{$patient->patient_id}}</b></td>
                  <td>{{$patient->patient_phone}}</td>
                  <td>{{memberShipLib::getNumberFormat($patient->total_amount)}}</td>
                  <td>{{memberShipLib::getNumberFormat($patient->discount_amount)}} ({{$patient->discount}}%)</td>
                  <td>{{memberShipLib::getNumberFormat($patient->payable_amount)}}</td>
                  <td>{{memberShipLib::getNumberFormat($patient->receive_amount)}}</td>
                  <td>{{memberShipLib::getNumberFormat($patient->due_amount)}}</td>
                  <td>
                     <div class="form-inline">
                        <div class = "input-group">
                          <a href="#viewModal{{$patient->id}}" class="btn btn-warning btn-xs" data-toggle="modal" style="padding: 1px 15px;">View Tests</a>
                        </div>
                        <div class = "input-group">
                          <a href='{{URL::to("diagnostic-invoice-print/$patient->id")}}' class="btn btn-info btn-xs" target="_blank" style="padding: 1px 15px;">Print Invoice</a>
                        </div>
                        
                       <!--  @if($add_edit==true)
                        <div class = "input-group">
                          <a href="#editModal{{$patient->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                        </div>
                        @endif
                        @if($delete==true)
                        <div class = "input-group"> 
                          {{Form::open(array('route'=>['diagnostic.destroy',$patient->id],'method'=>'DELETE'))}}
                            <button type="submit" confirm="Are you sure you want to delete this Information?" class="btn btn-danger btn-xs confirm" title="Delete" style="padding: 1px 9px;">Delete</button>
                          {!! Form::close() !!}
                        </div>
                        @endif -->
                        
                    </div>
                    <?php

                        $testList = DB::table('diagnostic_patient_test')->join('pathology_test','diagnostic_patient_test.test_id','pathology_test.id')
                                    ->select('diagnostic_patient_test.*','pathology_test.test_name','pathology_test.short_name')
                                    ->where('diagnostic_patient_test.diagnostic_id',$patient->id)
                                    ->orderBy('diagnostic_patient_test.id','asc')->get();

                        
                    ?>
                    <div class="modal fade" id="viewModal{{$patient->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content panel-warning" style="">
                          <div class="modal-header panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"> <i class="fa fa-stethoscope"></i> Patient Diagnostic Test</h4>
                          </div>
                            
                          <div class="modal-body">
                            <div class="table-responsive">
                              <table class="table table-responsive table-striped table-hovered table-bordered">
                                <th>Test Name</th>
                                <th style="text-align: center;">Qty</th>
                                <th >Amount</th>
                                <th >Test Report Progress Status</th>
                                <th style="text-align: center;">Delivery Date</th>
                                <th style="text-align: center;">Time</th>
                                <tbody>
                                  @foreach($testList as $test)
                                    <tr>
                                      <td>{{$test->test_name}} ({{$test->short_name}})</td>
                                      <td align="center">{{$test->quantity}}</td>
                                      <td >{{memberShipLib::getNumberFormat($test->test_amount)}}</td>
                                      <td id="label_{{$test->id}}">
                                        @if($test->progress_status == 2)
                                        <label class="label label-success">Completed</label>
                                        @elseif($test->progress_status == 1)
                                        <label class="label label-warning">Pending</label>
                                        @endif

                                        @if($test->progress_status == 3)
                                        <label class="label label-danger">Delivered</label>
                                        @elseif($test->progress_status == 2)
                                        <a onclick="changeDeliveryStatus('{{$test->id}}');" data-toggle="tooltip" title="Click To Deliver"> 
                                          <label class="label label-success" style="cursor: pointer">
                                            <i class="fa fa-sign-out"></i>
                                          </label>
                                        </a>
                                        @endif
                                      </td>
                                      <td align="center">{{date('d/m/Y',strtotime($test->test_delivery_date))}}</td>
                                      <td align="center">{{$test->test_delivery_time}}</td>
                                    </tr>
                                  @endforeach
                                 
                                  <tr>
                                    <td colspan="2" style="border-top: 1px solid #000;font-weight: bold;">Total Amount</td>
                                    <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patient->total_amount)}}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="border-top: 1px solid #000;font-weight: bold;">Discount {{memberShipLib::getNumberFormat($patient->discount)}} %</td>
                                    <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patient->discount_amount)}}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="border-top: 1px solid #000;font-weight: bold;">Payable</td>
                                    <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patient->payable_amount)}}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="font-weight: bold;">Received</td>
                                    <td colspan="3" style="font-weight: bold;">{{memberShipLib::getNumberFormat($patient->receive_amount)}}</td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="border-top: 1px solid #000;font-weight: bold;">Due</td>
                                    <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patient->due_amount)}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  
                          </div>
                            
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              @else
              <tbody>
                
                  <tr>
                    <td colspan="8" style="text-align: center;"> No Information Found ...</td>
                  </tr>
              
              </tbody>
              @endif
        </table>
        @if(!empty(json_decode(json_encode($patientList), true)))
          <div align="center">{{ $patientList->render() }}</div>
        @endif
      </div>
    </div>
    <div class="box-footer"> </div>
  </div>

  <script type="text/javascript">
    function changeDeliveryStatus($testId){
      $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        method: "POST",
        url: "{{URL::to('change-delivery-status')}}",
        data: {
          'id': $testId,
        },
        dataType: "json",
        success: function(data){
          if(data.result==true){
            $("#label_"+$testId).html('<label class="label label-danger">Delivered</label>');
          }
        },
        error: function(data){
        }
      });
    }
  </script>
</section>
@endsection 