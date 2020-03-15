<?php  
  use App\Library\pmscommon;
  $add_edit = pmscommon::userWiseAccessSelection('add_edit');
?>
@if($add_edit==false)
  <script type="text/javascript">window.location.href = '{{url("dashboard")}}';</script>
@endif
@extends('layouts.layout')
@section('title', 'Diagnostic Entry')
@section('content')
<section class="content-header">
  <h1><i class="fa fa-medkit"></i> Diagnostic Tests</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{URL::to('diagnostic')}}">Diagnostic List</a></li>
    <li class="active">Add Diagnostic</li>
  </ol>
</section>
<style type="text/css">
  .form-control {
      height: 28px;
      padding: 0px 12px;
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
        {{Form::open(array('route'=>['diagnostic.update',$singlePurchaseData->id],'method'=>'PUT','files'=>true))}}
        <?php 
              $btn_text = "Update Information"; $desplay_css= "block"; 
              $btn_print_text = "Update & Print Invoice";
              $date = date('m/d/Y', strtotime($singlePurchaseData->invoice_date)); 
              $btn_name = "update_print_btn";
        ?>
  @else
        {{Form::open(array('route'=>['diagnostic.store'],'method'=>'POST','files'=>true))}}
   @endif
  <div class="box box-success">
    <div class="box-header with-border" align="right">
        <button type="submit" class="btn btn-success" name="{{$btn_name}}"><i class="fa fa-print"></i> <b>{{$btn_print_text}}</b></button>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <b>{{$btn_text}}</b></button>
      &nbsp;&nbsp; 
        <a href="{{url('diagnostic')}}" class="btn btn-primary"><i class="fa fa-align-justify"></i> <b>Diagnostic Patient List</b></a> 
    </div>

   <div class="box-body">
    <div class="col-md-12">
     <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-user"></i> Patient Information</div>
          <div class="panel-body">
            <div class="col-md-12">
              <div class="form-group">
                <label for="refd_by" >Search Patient Id: </label>
                <input type="text" name="" id="search-patient" class="form-control" placeholder="Type Patient ID Or Name" style="height: 45px;" onclick="autocompletePatient();">
                  <input type="hidden" name="d_patient_id" id="patientId">
              </div>
          </div>
          <div class="col-md-12">
              <div class="form-group">
                <label class="label label-success" id="addPatient" style="display: none;">
                  <a href="{{URL::to('patient')}}" style="color: #fff;">Add Patient</a>
                </label>
               
              </div>
          </div>
              <div class="col-md-3">
              <div class="form-group">
                  <label for="patient_name">Patient Name:</label>
                  <input type="text" name="patient_name" class="form-control" value="{{isset($doctorData->patient_name)?$doctorData->patient_name:old('patient_name')  }}" placeholder="Patient Name" id="patient_name">
                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="patient_age">Patient Age:</label>
                  <input type="text" name="patient_age" class="form-control decimal" value="{{isset($doctorData->patient_age)?$doctorData->patient_age:old('patient_age')  }}" placeholder="Patient Age" id="patient_age">
                </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                  <label for="patient_phone">Phone Number:</label>
                  <input type="text" name="patient_phone" class="form-control decimal" value="{{isset($doctorData->patient_phone)?$doctorData->patient_phone:old('patient_phone')  }}" placeholder="+8801XXXXXXXXXXX" id="patient_phone">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="gender" >Gender: </label>
                  <select class="form-control" name="gender" id="gender">
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                  </select>
                  
                  
                </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="refd_by" >Reference by: </label>
                <input type="text" name="" id="referrer_search" class="form-control" placeholder="Type Referrer Name" style="height: 45px;" onclick="autocompleteDoctor();">
                  <input type="hidden" name="refd_by" id="refd_by">
              </div>
            </div>
          </div>
       </div>  
  </div>
   
  <div class="col-md-12">
     <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-search"></i> Diagnostic Test Search</div>
          <div class="panel-body">
            <div class="col-md-10">
        <div class="form-group">
            <label for="search_patient">Search Test:</label>
            <input type="text" name="search_patient" class="form-control" placeholder="Search test by test full name or short name" style="height: 40px;border-radius: 10px;" id="test_search">
          </div>
      </div>
      
          </div>
       </div>  
  </div>
  <div class="col-md-12">
     <div class="panel panel-info">
          <div class="panel-heading" style="font-size: 22px; font-weight:bold"><i class="fa fa-stethoscope"></i> Diagnostic Tests</div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-responsive table-stripped table-bordered">
                <th>Test Name</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Delivery Date/Time</th>
                <th align="center">Action</th>
                <tbody id="testData">
                  
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
                          <input type="text" name="discount" id="discount" class="form-control decimal" onblur="getTotal()">
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
                          <input type="text" name="total_payable" id="total_payable" class="form-control" readonly="" >
                      </td>
                      <td>&nbsp;</td>
                  </tr>
                  
                  <tr class="dynamicFooter">
                      <td colspan="2" align="right"> <b>Received Amount :</b> </td>
                      <td>
                       <input type="text" name="receive_amount" id="receive_amount" class="form-control decimal" onblur="getTotal()" required >
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
                  <tr class="dynamicFooter">
                      <td colspan="2" align="right"> <b>Grand Total :</b> </td>
                      <td>
                          <input type="text" name="grand_total" id="grand_total" class="form-control" readonly="">
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
   var rowNumber = 0;

   function autocompletePatient(){
    $('#search-patient').autocomplete({
      source: "{{URL::to('search-ot-patient')}}",
      minLength: 2,
      select: function( event, ui ) {
        $('#patient_name').prop('readonly', true);
        $('#patient_age').prop('readonly', true);
        $('#patient_phone').prop('readonly', true);
        $('#gender').prop('readonly', true);

        $("#patientId").val(ui.item.patient_id);
        $("#search-patient").val(ui.item.label);
        $('#patient_name').val(ui.item.p_name);
        $('#patient_age').val(ui.item.age_year);
        $('#patient_phone').val(ui.item.p_phone);
        if(ui.item.p_gender ==1){
          $('#gender').val('Male');
          $('#genderStatus').val(ui.item.p_gender);
        }else{
          $('#genderStatus').val(ui.item.p_gender);
        }
        
        
      }
    });
  }
   function autocompleteDoctor(){
    $('#referrer_search').autocomplete({
      source: "{{URL::to('search-auto-doctor-list')}}",
      minLength: 2,
      select: function( event, ui ) {
        $("#refd_by").val(ui.item.id);
        $("#referrer_search").val(ui.item.label);
      }
    });
  }
    $('#test_search').autocomplete({
        source: "{{URL::to('search-tests')}}",
        minLength: 2,
        select: function(event, ui) {

            if ($('#testData').parent().find('.fepro_' + ui.item.id).length == 1) {
                alert("This Test already added! Please try another one!");

            } else {
              $('#test_search').val('');
                html = '<tr id="test_row_'+rowNumber+'" class="test_name_row_'+rowNumber+'">';
                html += '<td>'+ui.item.label+'('+ui.item.short_name+')';
                html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][test_id]" value="'+ui.item.id+'" id="testId_'+rowNumber+'" class="fepro_'+ui.item.id+'"/>';
                html += '</td>';
                html += '<td>1';
                html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][test_qty]" value="1" class="item_quantity" id="item_qty_'+rowNumber+'" />';
                html += '</td>';
                html += '<td>'+ui.item.amount;
                html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][test_amount]" value="'+ui.item.amount+'" class="test_amount" id="testAmount_'+rowNumber+'"/>';
                html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][pr_price]" value="'+ui.item.pr_amount+'" class="pr_price" id="testAmount_'+rowNumber+'"/>';
                html += '</td>';
                html += '<td>'+ui.item.deliveryDate+'  '+ui.item.delivery_time;
                html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][test_delivery_date]" value="'+ui.item.deliveryDate+'" id="testDate_'+rowNumber+'"/>';
                 html += '<input type="hidden" name="test_diagnostic['+rowNumber+'][test_delivery_time]" value="'+ui.item.delivery_time+'" id="testDelTime_'+rowNumber+'"/>';
                html += '</td>';
                
                
                html += '<td style="vertical-align: middle;"><button class="btn btn-danger btn-xs" onclick="$(\'.test_name_row_'+rowNumber+'\').remove();getTotal()">Remove</button></td>';
                html += '</tr>';

                rowNumber++;
                
                
                $('#testData').append(html);
                getTotal(rowNumber);
            }
        }
    }); 
  function getTotal(rowId){
    
    if($("#testAmount_"+rowId).val()=='0.00'){ 
          $("#discount").val('');
          
          $("#sub_total").val(0.00);
          $("#due_amount").val(0.00);
          $("#sub_total").val(0.00);
          $("#receive_amount").val('');
        }

        var mul_result = subTotal = discount = due_amount = 0;
        var x = jQuery(".test_amount");
        $.each(x, function (index, value) { 

            var idDigit = ($(value).attr('id')).split("_"); 
            var unitPrice  = $("#testAmount_"+idDigit[1]).val();
            //console.log(unitPrice);
            
            
            
            var item_quantity_value = $(value).val();
            //console.log(item_quantity_value);
            if(parseFloat(item_quantity_value) ==0 || parseFloat(item_quantity_value) =='undefined'){

              $(value).val(1);
            }
           

            mul_result = unitPrice;
            subTotal = parseFloat(subTotal) + parseFloat(mul_result);

        });
        
        
        $("#sub_total").val(subTotal.toFixed(2));

        $("#total_payable").val(subTotal.toFixed(2));
        //console.log(subTotal.toFixed(2));
        $('#due_amount').val(subTotal.toFixed(2));
        $('#grand_total').val(subTotal.toFixed(2));

        if($("#discount").val())
        {
          discount = $("#discount").val();
        }
        var discount_amount = ((parseFloat(subTotal)*parseFloat(discount))/100);

        var subtotal_with_disc = parseFloat(subTotal)-((parseFloat(subTotal)*parseFloat(discount))/100);
        if(isNaN(subtotal_with_disc))
        {
          var defaultval = 0;
          $("#total_payable").text(defaultval.toFixed(2));
          
          $('#due_amount').val(defaultval.toFixed(2));

          $("#total_payable").val(defaultval.toFixed(2));
        }
        else 
        {
          
          $("#total_payable").val(subtotal_with_disc.toFixed(2));
          $("#discount_amount").val(discount_amount.toFixed(2));

          $('#due_amount').val(subtotal_with_disc.toFixed(2));
        }

        if($("#receive_amount").val())
        {
          var cash_amount = $("#receive_amount").val();
          due_amount = parseFloat($("#total_payable").val()) - parseFloat(cash_amount);
          $('#due_amount').val(due_amount.toFixed(2));
        }

        
        // console.log(due_amount);
        
        

  }
</script>
@endsection
