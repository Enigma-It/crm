<?php  
	use App\Library\pmscommon;
	$add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
	<script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Diagnostic Patient Due')
@section('content')
<section class="content-header">
  <h1><i class="fa fa-medkit"></i> Diagnostic Patient Due</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    
  </ol>
</section>
<style type="text/css">
	.form-control {
    	height: 28px;
    	padding: 0px 12px;
	}
</style>
<style type="text/css">
  .zInputWrapper{
    
    padding: 4px;
    margin: 2px;
    border-radius:12px;
    display:inline-block;
    }

    .zInput{
    display: inline-block;
    width: 75px;
    height: 30px;
    background-color: white;
    margin: 4px;
    padding: 4px;
    text-align: center;
    cursor: default;
    color: #336600;
    border: 1px solid #D7DCE5;
    border-radius: 4px;
    font-size: 11px;
    overflow: hidden;
    }


    .zCheckbox{
    color: #000099;
    border: #000099 1px solid;
    }

    .zSelected{
    color: white;
    background-color:#00a65a;
    }

    .zSelected.zCheckbox{
      background-color: #000099;

    }
    .item_quantity{
      text-align: center;
    }
</style>
<section class="content">
  @include('common.message')
  @include('common.commonFunction')

  <?php 
  
  
  $btn_text = "Save Information"; $desplay_css= "none"; $date = date('m/d/Y'); 
  $btn_print_text = "Save & Print Invoice";
  $btn_name = "save_print_btn";
?>

  @if( !empty($singlePurchaseData) )
        {{Form::open(array('route'=>['diagnostic-patient-due-pay.update',$singlePurchaseData->id],'method'=>'PUT','files'=>true))}}
        <?php 
              $btn_text = "Update Information"; $desplay_css= "block"; 
              $btn_print_text = "Update & Print Invoice";
              $date = date('m/d/Y', strtotime($singlePurchaseData->invoice_date)); 
              $btn_name = "update_print_btn";
        ?>
  @else
        {{Form::open(array('route'=>['diagnostic-patient-due-pay.store'],'method'=>'POST','files'=>true))}}
   @endif
  <div class="box box-warning">
    <div class="box-header with-border" align="right">
        <button type="submit" class="btn btn-warning" name="{{$btn_name}}"><i class="fa fa-print"></i> <b>{{$btn_print_text}}</b></button>
        <button type="submit" class="btn btn-warning"><i class="fa fa-floppy-o"></i> <b>{{$btn_text}}</b></button>
      &nbsp;&nbsp; 
        <a href="{{url('diagnostic')}}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b>Diagnostic Patient List</b></a> 
    </div>

   <div class="box-body">
    
  	<div class="col-md-12">
  	   <div class="panel panel-warning">
            <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-barcode"></i> Scan Patient ID</div>
            <div class="panel-body">
            	<div class="col-md-10">
                <div class="pull-right" style="">
                    <div id="affected" class="pull-right">
                      @if($configuration->is_scanned == 1)
                        <input type="radio" name="set 2" class="commonradio" title="Scanner Input" checked value="{{$configuration->is_scanned}}">

                        <input type="radio" name="set 2" class="commonradio" title="Manual Input" value="2">
                      @else
                        <input type="radio" name="set 2" class="commonradio" title="Scanner Input" value="1">
                        <input type="radio" name="set 2" class="commonradio" title="Manual Input" checked value="{{$configuration->is_scanned}}">
                      @endif
                    </div>

                </div>
        				<div class="form-group">
        			      <input type="text" name="search_patient" id="invoice-search" class="form-control invoice-scanner-input" placeholder="Scan barcode" autofocus="autofocus" style="height: 50px">
                    <input type="search" name="search_patient" id="invoice-search-manual" onblur="invoiceSearchByPatientID(this.value)" class="form-control manual-input" placeholder="Enter patient id manually" autofocus="autofocus" style="display: none;height: 50px">
             
                    <input type="button" name="" id="getValue" style="display: none;">
        			   </div>
        			</div>
  			
            </div>
         </div>
         
  	</div>
    <div class="col-md-12">
         <div class="panel panel-warning">
           <div class="panel-heading" style="font-size: 22px; font-weight:bold">Invoice</div>
           <div class="panel-body">
             <div class="table-responsive" id="invoiceData">
               <table class="table table-responsive table-stripped table-bordered">
                  <tbody>
                      <tr>
                        <td style="font-size: 16px" colspan="2">ID No : <b class="patient_id"></b>
                          <input type="hidden" name="patient_id_old" id="patientId">
                        </td>
                        <td style="float: right;font-size: 16px">Date: <span class="date"></span></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="font-size: 16px">Name : <b class="patient_name"></b></td>
                        
                      </tr>
                      <tr>
                        <td style="font-size: 16px">Age : <span class="patient_age"></span></td>
                        <td align="center" style="font-size: 16px">
                          Sex : <span class="p_sex"></span>
                        </td>
                        <td style="float: right;font-size: 16px">Mobile : <span class="p_phone"></span></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="font-size: 16px">Refd By : <span class="ref_by"></span></td>
                        
                      </tr>
                  </tbody>
                  
               </table>
               <table class="table table-responsive table-stripped table-bordered">
                  <th>Test Name</th>
                  <th>Qty</th>
                  <th>Amount</th>
                  <th>Delivery Date/Time</th>
                  <tbody id="testData">
                    
                  </tbody>
                  <tbody id="testEquipment">
                    
                  </tbody>
                  <tfoot>
                   
                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Total Amount:</b> </td>
                        <td>
                            <input type="text" name="total_amount" id="sub_total" class="form-control" readonly="" >
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Discount(%) :</b> </td>
                        <td>
                            <input type="text" name="discount" id="discount" class="form-control decimal" onkeyup="getTotal();">
                        </td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Discount Amount :</b> </td>
                        <td>
                            <input type="text" name="discount_amount" id="discount_amount" class="form-control" readonly="" >
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Total Payable :</b> </td>
                        <td>
                            <input type="text" name="total_payable" id="total_payable" class="form-control" readonly="" readonly="">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    
                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Received Amount :</b> </td>
                        <td>
                         <input type="text" name="receive_amount" id="receive_amount" class="form-control decimal" onblur="getTotal()" onkeyup="getTotal()">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr class="dynamicFooter">
                        <td colspan="2" align="right"> <b>Due Amount:</b> </td>
                        <td>
                            <input type="text" name="due_amount" id="due_amount" class="form-control" readonly="">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    
                </tfoot>
              </table>
             </div>
           </div>
         </div>  
       </div>
	</div>
  	{!! Form::close() !!} 
   </div>
</section>
<script type="text/javascript">
  $("#affected").zInput();

  $('.zInput').on('click',function(){
   
    if($('.commonradio').prop("checked") == true){
      //alert('a');
       $(this).parent().children().removeClass("zSelected");
       $(this).addClass("zSelected");
       $('.invoice-scanner-input').css('display','block');
       $('.manual-input').css('display','none');
    }else{
       //alert('b');
      $(this).parent().children().removeClass("zSelected");
      $(this).addClass("zSelected");
      $('.manual-input').css('display','block');
      $('.invoice-scanner-input').css('display','none');
    }
  })
  //USB barcode scanner detection //
  $('.invoice-scanner-input').scannerDetection({
    timeBeforeScanTest: 200,
    avgTimeByChar: 40,
    
    onComplete: function(barcode, qty){invoiceSearchByPatientID(barcode)},
    
  });
	 //var rowNumber = 0;

   function invoiceSearchByPatientID(value){

    $('#invoice-search').val(value);
    if(value !=''){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            method: "POST",
            url: "{{URL::to('test-list-by-invoice')}}",
            data: {
              'invoice': value
            },
            dataType: "json",
            success: function(data){

              if(data !="" || data >0)
              {   
                  $('#invoice-search').val('');
                  var rowNumber = 0;
                  $('#patientId').val(data.patientInfo.id);
                  $('.patient_id').text(data.patientInfo.patient_id);
                  var date = new Date(data.patientInfo.date);
                  var getDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' +  date.getFullYear();
                 
                  $('.date').text(getDate);
                  $('.patient_name').text(data.patientInfo.patient_name);
                  $('.patient_age').text(data.patientInfo.patient_age);
                  
                  if(data.patientInfo.patient_gender == 1){
                    $('.p_sex').text('Male');
                  }else{
                    $('.p_sex').text('Female');
                  }
                  $('.p_phone').text(data.patientInfo.patient_phone);
                  if(data.patientInfo.refd_by !=null){
                                                                                                                                  
                    $('.ref_by').text(data.patientInfo.first_name +' '+ data.patientInfo.last_name +', '+ data.patientInfo.specialist + ', '+ data.patientInfo.educational_qualification);
                  }else{
                    $('.ref_by').text('');
                  }
                  
                  $('#testData').html('');
                  $.each(data.patientList, function (index, value) {
                        var deliverDate = new Date(value.test_delivery_date);
                        var deliveryDateChange = deliverDate.getDate() + '/' + (deliverDate.getMonth() + 1) + '/' +  deliverDate.getFullYear();
                        html = '<tr>';
                        html += '<td >';
                        html += value.test_name;
                        html += '</td>';
                        html += '<td>'+value.quantity+'</td>';
                        html += '<td>'+value.test_amount+'</td>';
                        html += '<td>'+deliveryDateChange+'&nbsp;&nbsp;&nbsp;&nbsp;   '+value.test_delivery_time+'</td>';
                        

                        html += '</tr>';
                        rowNumber++;
                        var $itemData = $('#testData');
                        $itemData.append(html);
                  });
                  if(data.patientEquipment !=''){
                    $.each(data.patientEquipment, function (index1, value1) {
                        
                        html = '<tr>';
                        html += '<td >';
                        html += value1.equipment_name;
                        html += '</td>';
                        html += '<td>'+value1.equipment_qty+'</td>';
                        html += '<td colspan="2">'+value1.equipment_price+'</td>';
                        

                        html += '</tr>';
                        rowNumber++;
                        var $itemData = $('#testEquipment');
                        $itemData.append(html);
                    });
                  }
                  $('#sub_total').val(data.patientInfo.total_amount);
                  $('#discount').val(data.patientInfo.discount);
                  $('#discount_amount').val(data.patientInfo.discount_amount);
                  $('#total_payable').val(data.patientInfo.payable_amount);
                  $('#receive_amount').val(data.patientInfo.receive_amount);
                  $('#due_amount').val(data.patientInfo.due_amount);

              }
              else
              {
                  $('#patientId').val('');
                  $('.patient_id').text('');
                  $('.date').text('');
                  $('.patient_name').text('');
                  $('.patient_age').text('');
                  $('.p_sex').text('');
                  $('.p_phone').text('');
                  $('.ref_by').text('');

                  html  = '<tr>';
                  html += '<td colspan="4">';
                  html += '<div class="text-center" style="color: #E57765">';
                  html += '<h3>There are no Patients with this Patient Id </h3>';
                  html += '</div>';
                  html += '</td>';
                  html += '</tr>';

                  html1  = '<tr>';
                  html1 += '<td colspan="4">';
                  
                  html1 += '</td>';
                  html1 += '</tr>';
                  
                  var $itemData = $('#testEquipment');
                  $('#testData').html('');
                  $('#testData').append(html);
                  $('#testEquipment').html('');
                  $('#testEquipment').append(html1);

                  $('#sub_total').val('');
                  $('#discount').val('');
                  $('#discount_amount').val('');
                  $('#total_payable').val('');
                  $('#receive_amount').val('');
                  $('#due_amount').val('');

                  $.notify('No Diagnostic Patient Found!','warn');
                  $('#invoice-search').val('');
              }
            },
            error: function(data){
             
            }
        });
    }
  }

  function getTotal(rowId){
    var receive_amount = due_amount = total_payable = discount = subTotal = 0;
    if($("#sub_total").val()){
      subTotal = $("#sub_total").val();
    }
    if($("#discount").val()){
      discount = $("#discount").val();
    }
    var discount_amount = ((parseFloat(subTotal)*parseFloat(discount))/100);
    $("#discount_amount").val(discount_amount.toFixed(2));
    var subtotal_with_disc = parseFloat(subTotal)-parseFloat(discount_amount);
    $("#total_payable").val(subtotal_with_disc.toFixed(2));
    if($("#total_payable").val()){
      total_payable = $("#total_payable").val();
    }
    if($('#receive_amount').val()){
      receive_amount = $('#receive_amount').val();  
    }
    due_amount = parseFloat(total_payable) - parseFloat(receive_amount);
    $('#due_amount').val(due_amount.toFixed(2));
  }
</script>
@endsection
