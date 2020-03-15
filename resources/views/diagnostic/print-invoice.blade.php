@extends('layouts.layout')
@section('title', 'Diagnostic Test Invoice')
@section('content')
<?php use App\Library\memberShipLib; ?>
<section class="content-header">
  <h1><i class="fa fa-print"></i> Diagnostic Test Invoice</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#"> Diagnostic Test Invoice</a></li>
  </ol>
</section>
<style type="text/css">
    .table>tbody>tr>td{
        padding: 2px;
    }
</style>
<section class="content">

  <div class="box box-success">
    <div class="box-body">
      <div id="printTable" style="width: 600px; margin: 0 auto;">

        <div style="position:absolute;right:0;margin-right:15px;" id="print_icon">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
            <a onclick="printReport();" href="javascript:void(0)" class="btn btn-success">Print</a>
        </div>
        <div class="" style="width: 550px">
            
        </div>
        <div style="margin-top:5px;margin-bottom: 10px;width: 600px;color: #17144c;text-align: center; height:60px;border-bottom: 2px solid #000;float: left;">
            <div style="width: 20%;float: left;border-right: 2px solid #000">
                 <img src="{{asset('public/custom/img/prob.png')}}" style="width: 110px;height: 50px;">
            </div>
            <div style="width: 80%;float: left;" align="center">
              <h2 style="color: #ca1a1a;text-align: center;margin-top: 5px;font-size: 2.5em;font-weight: bold;font-family: 'Libre Baskerville', serif;">
                Probe Diagnostic Center
              </h2>
            </div>
        </div> 
        <table class="table" style="border: 1px dotted #000 !important;border-radius: 5px;margin-top: 10px;width: 600px;">
            <tr>
                <td style="font-size: 16px">ID No : <b>{{$patientInfo->patient_id}}</b></td>
                <td align="center">{!! DNS1D::getBarcodeSVG($patientInfo->patient_id,'C128') !!}</td>
                <td style="float: right;font-size: 16px">Date: {{date('d F y', strtotime($patientInfo->date))}}</td>
            </tr>
            <tr>
                <td colspan="3" style="font-size: 16px">Name : <b>{{$patientInfo->patient_name}}</b></td>
                
            </tr>
            <tr>
                <td style="font-size: 16px">Age : {{$patientInfo->patient_age}}</td>
                <td align="center" style="font-size: 16px">
                    Sex : @if($patientInfo->patient_gender ==1) Male @else Female @endif
                </td>
                <td style="float: right;font-size: 16px">Mobile : {{$patientInfo->patient_phone}}</td>
            </tr>
            <tr>
                @if($patientInfo->refd_by !=null)
                <td colspan="3" style="font-size: 16px">Refd By : {{$patientInfo->first_name}} {{$patientInfo->last_name}}, {{$patientInfo->specialist}}, {{$patientInfo->educational_qualification}}</td>
                @else
                <td colspan="3" style="font-size: 16px">Refd By : </td>
                @endif
            </tr>
        </table>
        <table class="table" style="width: 600px;">
            <tr style="font-weight: bold;border: 1px solid #ccc;border-radius: 5px;">
                <td style="border: 1px solid #ccc;">SL</td>
                <td style="border: 1px solid #ccc;">Test Name</td>
                <td style="border: 1px solid #ccc;">Qty</td>
                <td style="border: 1px solid #ccc;">Amount</td>
                <td style="border: 1px solid #ccc;">Delivery Date</td>
                <td style="border: 1px solid #ccc;">Time</td>
            </tr>
            <?php
                $i = 1;
            ?>
            @if(isset($patientTest))
                @foreach($patientTest as $test)
                    <tr>
                        <td style="border: 1px solid #ccc;">{{$i++}}</td>
                        <td style="border: 1px solid #ccc;">{{$test->test_name}} ({{$test->short_name}})</td>
                        <td style="border: 1px solid #ccc;" align="center">{{$test->quantity}}</td>
                        <td style="border: 1px solid #ccc;">{{memberShipLib::getNumberFormat($test->test_amount)}}</td>
                        <td style="border: 1px solid #ccc;" align="center">{{date('d/m/Y',strtotime($test->test_delivery_date))}}</td>
                        <td style="border: 1px solid #ccc;" align="center">{{$test->test_delivery_time}}</td>
                    </tr>
                    
                @endforeach
            @endif
            
            <tr>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">Total Amount</td>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patientInfo->total_amount)}}</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">Discount {{$patientInfo->discount}} %</td>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patientInfo->discount_amount)}}</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">Payable</td>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patientInfo->payable_amount)}}</td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold;">Received</td>
                <td colspan="3" style="font-weight: bold;">{{memberShipLib::getNumberFormat($patientInfo->receive_amount)}}</td>
            </tr>
            <tr>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">Due</td>
                <td colspan="3" style="border-top: 1px solid #000;font-weight: bold;">{{memberShipLib::getNumberFormat($patientInfo->due_amount)}}</td>
            </tr>
        </table>
         <div style="margin-top: 20px;width: 600px;height: 50px;float: left;">
            @if($patientInfo->due_amount !=0.00)
             <div style="width: 70px; border:2px solid #ff0000;font-weight: bold;font-size: 25px;padding: 5px 5px;color: #ff0000;font-family: sans-serif;transform: rotate(-45deg);-webkit-transform: rotate(-45deg);-moz-transform: rotate(-45deg);-ms-transform: rotate(-45deg);-o-transform: rotate(-45deg);">
                 <span class="" style="text-transform: uppercase;">Due</span>
                
             </div>
             @else
             <div style="width: 70px; border:2px solid #3aa65a;font-weight: bold;font-size: 25px;padding: 5px 5px;color: #3aa65a;font-family: sans-serif;transform: rotate(-45deg);-webkit-transform: rotate(-45deg);-moz-transform: rotate(-45deg);-ms-transform: rotate(-45deg);-o-transform: rotate(-45deg);">
                 <span class="" style="text-transform: uppercase;">Paid</span>
                
             </div>
                 
            @endif
         </div>
         <div style="width: 600px;float: left;">
             <div style="float: right; width: 150px; text-align: center;">
                 <span style="font-weight: 600">{{Auth::user()->name}}</span>
                
             </div>
         </div>
          <div style="margin-top: 20px;width: 600px;height: 50px;">
             <div style="float: right; width: 150px; border-top: 1px solid #000; text-align: center;">
           
                 <span>(Signature)</span>
             </div>
         </div>
        
          <div style="margin-top: 50px;width: 600px;float: left;">
             <div style="width: 100%;">
                <p style="color: #000;font-weight: 600">House No - 09, R.No- 01, B-F
Janata Co-operative Housing Society Ltd
Ring Road, Adabar, Dhaka-1207</p>
         
             </div>
         </div>
         
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer"> </div>
    <!-- /.box-footer-->
  </div>

</section>
<script type="text/javascript">
  function printReport() {
       $("#print_icon").hide();
       var reportTablePrint=document.getElementById("printTable");
       newWin= window.open("");
       newWin.document.write(reportTablePrint.innerHTML);
       newWin.print();
       newWin.close();
       $("#print_icon").show();
}
</script>
<!-- /.content -->
@endsection 